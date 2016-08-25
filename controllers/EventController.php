<?php

    namespace app\controllers;

    use app\models\ParticEvent;
    use app\models\User;
    use Yii;
    use app\models\Event;
    use app\models\search\EventSearch;
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
                'verbs'  => [
                    'class'   => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow'   => true,
                            'actions' => ['event-list'],
                            'roles'   => ['?'],
                        ],
                        [
                            'allow' => true,
                            'roles' => ['admin', 'moder', 'user'],
                        ],
                    ],
                ],
            ];
        }

        public function actionEventList(){
            $searchModel = new EventSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('event-list', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        public function actionConfirmParticip($id, $confirm = true){
            $model = ParticEvent::findOne($id);
            if($confirm){
                $model->confirmed = 1;
                $model->save();
            }else{
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
            $partEvent = ParticEvent::findOne(['event_id' => $id, 'user_id' => Yii::$app->user->id]);
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
            $particEvent = new ParticEvent(['user_id' => $user->id, 'event_id' => $event->id]);
            $particEvent->confirmed = false;
            $particEvent->confirmedtext = $requset['body'];
            $particEvent->save();

            $this->redirect('event-list');
        }

        /**
         * Lists all Event models.
         * @return mixed
         */
        public function actionIndex(){
            $searchModel = new EventSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel'  => $searchModel,
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
            $participDataProvider = new ActiveDataProvider([
                                                               'query' => $model->getParticEvents()
                                                                                ->andWhere(['user_id' => Yii::$app->user->id])
                                                                                ->andWhere(['confirmed' => 0])
                                                           ]);

            return $this->render('view', [
                'model'                => $this->findModel($id),
                'participDataProvider' => $participDataProvider,
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
                return $this->redirect(['view', 'id' => $model->id]);
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
                return $this->redirect(['view', 'id' => $model->id]);
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
    }
