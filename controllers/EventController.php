<?php

    namespace app\controllers;

    use app\models\Comments;
    use app\models\ParticEvent;
    use app\models\User;
    use app\widgets\rateCounter\VoteAction;
    use Yii;
    use app\models\Event;
    use app\models\search\EventSearch;
    use yii\sergsova\fileManager\actions\UploadAction;
    use yii\sergsova\fileManager\models\UploadPictureModel;
    use yii\data\ActiveDataProvider;
    use yii\filters\AccessControl;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    use yii\filters\VerbFilter;
    use yii\web\UploadedFile;

    /**
     * EventController implements the CRUD actions for Event model.
     */
    class EventController extends Controller{
        /**
         * @inheritdoc
         */
        public function behaviors(){
            return [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'upvote-event' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'event-list',
                                'event-calendar',
                                'view'
                            ],
                            'roles' => ['?'],
                        ],
                        [
                            'allow' => true,
                            'roles' => [
                                'admin',
                                'moder',
                                'user'
                            ],
                        ],
                    ],
                ],
            ];
        }

        public function actions(){
            return [
                'vote-event' => [
                    'class' => VoteAction::className(),
                    'type' => 'event'
                ],
                'vote-comment' => [
                    'class' => VoteAction::className(),
                    'type' => 'comments'
                ],
                'event-upload-photo' => [
                    'class' => UploadAction::className(),
                    'uploadPath' => 'event',
                    'sessionEnable' => true,
                    'uploadModel' => new UploadPictureModel([
                                                                'validationRules' => [
                                                                    'extensions' => 'jpg, png',
                                                                    'maxSize' => 1024 * 1024
                                                                ]
                                                            ])
                ],
                'event-remove-photo' => [
                    'class' => '\yii\sergsova\fileManager\actions\RemoveAction',
                ],
            ];
        }

        /**
         * Action view list all available events
         * @return string
         */
        public function actionEventList(){
            $searchModel = new EventSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('event-list', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        /**
         * Calendar with all available events
         * @return string
         */
        public function actionEventCalendar(){
            $eventsSearch = new EventSearch();
            $events = $eventsSearch->searchCalendar(Yii::$app->request->post());

            return $this->render('event-calendar', ['events' => $events]);
        }

        //region Particip
        public function actionConfirmParticip($id, $confirm = true){
            $model = ParticEvent::findOne($id);
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('participant');
            if($confirm){
                $model->confirmed = 1;
                $auth->assign($authorRole, $model->user_id);
                $model->save();
            }else{
                $auth->revoke($authorRole, $model->user_id);
                $model->delete();
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        public function actionAddParticip($id){
            $model = new ParticEvent();
            $model->user_id = Yii::$app->user->id;
            if(Event::findOne($id)->eventType->name == 'free'){

                $model->event_id = $id;
                if($model->save()){
                    $auth = Yii::$app->authManager;
                    $authorRole = $auth->getRole('participant');
                    $auth->assign($authorRole, $model->user_id);

                    Yii::$app->session->setFlash('success', 'Вы добавлены к событию.');
                }else{
                    foreach($model->getErrors() as $error){
                        Yii::$app->session->setFlash('error', $error[0]);
                    }
                }
            }else{
                Yii::$app->session->setFlash('error', 'Событие не доступно для регистрации');
            }

            return $this->redirect('event-list');
        }

        public function actionRemoveParticip($id){
            $partEvent = ParticEvent::findOne([
                                                  'event_id' => $id,
                                                  'user_id' => Yii::$app->user->id
                                              ]);
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('participant');
            $auth->revoke($authorRole, $partEvent->user_id);

            $partEvent->delete();

            return $this->redirect('event-list');
        }

        public function actionSendConfirm(){
            $user = Yii::$app->user->identity;
            $requset = Yii::$app->request->post('Mail');
            $event = Event::findOne($requset['event_id']);

            /** @var User $user */
            if(Yii::$app->mailer->compose()
                                ->setFrom([Yii::$app->params['supportEmail'] => $user->username])
                                ->setTo($event->creator->email)
                                ->setTextBody($requset['body'])
                                ->setSubject('Request from '.$user->username.' to event '.$event->title)
                                ->send()
            ){
                Yii::$app->session->setFlash('success', 'Запрос отправлен');
            }
            $particEvent = new ParticEvent([
                                               'user_id' => $user->id,
                                               'event_id' => $event->id
                                           ]);
            $particEvent->confirmed = false;
            $particEvent->confirmedtext = $requset['body'];
            $particEvent->save();

            $this->redirect('event-list');
        }
        //endregion

        /**
         * Lists all Event models.
         * @return mixed
         */
        public function actionIndex(){
            $searchModel = new EventSearch();
            $searchModel->creator_id = Yii::$app->user->id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        /**
         * Displays a single Event model.
         *
         * @param integer $id
         *
         * @return mixed
         */
        public function actionView($id){
            $model = $this->findModel($id);
            $commentModel = new Comments();
            $pendingDataProvider = new ActiveDataProvider([
                                                              'query' => $model->getParticEvents()
                                                                               ->andWhere(['confirmed' => 0])
                                                          ]);
            $participantsDataProvider = new ActiveDataProvider([
                                                                   'query' => $model->getParticEvents()
                                                                                    ->andWhere(['confirmed' => 1])
                                                               ]);

            return $this->render('view', [
                'model' => $this->findModel($id),
                'pendingDataProvider' => $pendingDataProvider,
                'participantsDataProvider' => $participantsDataProvider,
                'commentModel' => $commentModel
            ]);
        }

        /**
         * Creates a new Event model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate(){
            $model = new Event();
            if($model->load(Yii::$app->request->post()) && $model->save()){
                $model->imageFiles = UploadedFile::getInstance($model, 'imageFiles');

                //                if($model->upload()){
                return $this->redirect([
                                           'view',
                                           'id' => $model->id
                                       ]);
                //                }
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

        /**
         * Updates an existing Event model.
         * If update is successful, the browser will be redirected to the 'view' page.
         *
         * @param integer $id
         *
         * @return mixed
         */
        public function actionUpdate($id){
            $model = $this->findModel($id);

            if($model->load(Yii::$app->request->post()) && $model->save()){
                $model->imageFiles = UploadedFile::getInstance($model, 'imageFiles');

                //                if($model->upload() && ){
                return $this->redirect([
                                           'view',
                                           'id' => $model->id
                                       ]);
                //                }
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }

        /**
         * Deletes an existing Event model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         *
         * @param integer $id
         *
         * @return mixed
         */
        public function actionDelete($id){
            $this->findModel($id)
                 ->delete();

            return $this->redirect(['index']);
        }

        /**
         * Finds the Event model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         *
         * @param integer $id
         *
         * @return Event the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id){
            if(($model = Event::findOne($id)) !== null){
                return $model;
            }else{
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        public function actionAddComment(){
            $comment = new Comments();
            if($comment->load(Yii::$app->request->post()) && $comment->save()){
                return $this->redirect([
                                           'view',
                                           'id' => $comment->event_id
                                       ]);
            }

            return $this->refresh();
        }
    }
