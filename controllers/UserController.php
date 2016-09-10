<?php

    namespace app\controllers;

    use app\models\forms\LoginForm;
    use app\models\forms\PasswordChangeModel;
    use app\models\forms\RegistrationForm;
    use app\models\forms\RequestChangeMailForm;
    use app\models\SocialAcc;
    use app\widgets\rateCounter\VoteAction;
    use Yii;
    use app\models\User;
    use yii\filters\AccessControl;
    use yii\helpers\ArrayHelper;
    use yii\sergsova\fileManager\actions\RemoveAction;
    use yii\sergsova\fileManager\actions\UploadAction;
    use yii\sergsova\fileManager\FileManager;
    use yii\sergsova\fileManager\models\UploadPictureModel;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    use yii\filters\VerbFilter;

    /**
     * UserController implements the CRUD actions for User model.
     */
    class UserController extends Controller{
        /**
         * @inheritdoc
         */
        public function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => [
                                'login',
                                'registration'
                            ],
                            'allow' => true,
                            'roles' => ['?'],
                        ],
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'logout' => ['post'],
                        'get-users' => ['post']
                    ],
                ],
            ];
        }

        /**
         * @param \yii\base\Action $action
         *
         * @return bool
         */
        public function beforeAction($action){
            if($action->id == 'registration' || $action->id == 'login'){
                $this->enableCsrfValidation = false;
            }

            return parent::beforeAction($action);
        }

        /**
         * @return array
         */
        public function actions(){
            return [
                'vote-user' => [
                    'class' => VoteAction::className(),
                    'type' => 'user'
                ],
                'user-upload-photo' => [
                    'class' => UploadAction::className(),
                    'uploadPath' => 'user',
                    'sessionEnable' => true,
                    'uploadModel' => new UploadPictureModel([
                                                                'validationRules' => [
                                                                    'extensions' => 'jpg, png',
                                                                    'maxSize' => 1024 * 50
                                                                ]
                                                            ])
                ],
                'user-remove-photo' => [
                    'class' => RemoveAction::className(),
                ],
            ];
        }

        public function actionIndex(){
            $model = $this->findModel(Yii::$app->user->id);

            return $this->render('index', ['model' => $model]);
        }

        public function actionView($id){
            $model = $this->findModel($id);

            return $this->render('view',['model'=>$model]);
        }
        public function actionRequestChangeMail(){
            $model = new RequestChangeMailForm();
            if($model->load(Yii::$app->request->post()) && $model->sendConfirm()){
                return $this->goBack();
            }

            return $this->render('requestChangeEmail', ['model' => $model]);
        }

        public function actionChangeEmailToken($token, $newEmail){
            if(User::changeEmail($token, $newEmail)){
                return $this->redirect('index');
            }

            return $this->render('error');
        }

        public function actionChangePassword(){
            $model = new PasswordChangeModel();
            if($model->load(Yii::$app->request->post()) && $model->changePassword()){
                return $this->goBack();
            }

            return $this->render('change_password', ['model' => $model]);
        }

        public function actionRemoveSocial($id){
            return SocialAcc::findOne($id)
                            ->delete();
        }

        /**
         * Finds the User model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         *
         * @param integer $id
         *
         * @return User the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id){
            if(($model = User::findOne($id)) !== null){
                return $model;
            }else{
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        #region Login Registration Logout
        public function actionLogin(){
            if(!Yii::$app->user->isGuest){
                return $this->goHome();
            }

            $token = Yii::$app->request->post('token');
            if(isset($token) && User::loginByToken($token)){
                return $this->goBack();
            }

            $model = new LoginForm();
            if($model->load(Yii::$app->request->post()) && $model->login()){
                return $this->goBack();
            }

            return $this->render('login', [
                'model' => $model,
            ]);
        }

        public function actionRegistration(){
            $model = new RegistrationForm();
            if($model->load(Yii::$app->request->post()) && $model->register()){
                return $this->goBack();
            }

            return $this->render('registration', [
                'model' => $model,
            ]);
        }

        public function actionLogout(){
            Yii::$app->user->logout();

            return $this->goHome();
        }

        #endregion

        public function actionChangePhoto(){
            /** @var User $model */
            $model = Yii::$app->user->identity;
            $model->scenario = 'photo';

            if($model->load(Yii::$app->request->post())&&$model->save()){
                return true;
            }

            return false;
        }

        public function actionGetUsers(){
            $users = User::find()->select(['id', 'username', 'photo'])->where(['like', 'username', Yii::$app->request->post('search')])->asArray()->all();
            if(!empty($users)){
                foreach($users as $k=>$v){
                    $photo = json_decode($v['photo'])[0];
                    if(strpos('http', $photo) != -1){
                        $photo = FileManager::getInstance()->getStorageUrl().$photo;
                    }
                    $users[$k]['photo'] = $photo;
                }
                $users = $users;
            }
            return json_encode($users);
        }
    }
