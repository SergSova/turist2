<?php

    namespace app\controllers;

    use app\models\ContactForm;
    use app\models\LoginForm;
    use app\models\RegistrationForm;
    use app\models\User;
    use Yii;
    use yii\filters\AccessControl;
    use yii\web\Controller;
    use yii\filters\VerbFilter;

    class SiteController extends Controller{
        public function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only'  => ['logout'],
                    'rules' => [
                        [
                            'actions' => ['logout'],
                            'allow'   => true,
                            'roles'   => ['@'],
                        ],
                    ],
                ],
                'verbs'  => [
                    'class'   => VerbFilter::className(),
                    'actions' => [
                        'logout' => ['post'],
                    ],
                ],
            ];
        }

        public function actions(){
            return [
                'error'   => [
                    'class' => 'yii\web\ErrorAction',
                ],
                'captcha' => [
                    'class'           => 'yii\captcha\CaptchaAction',
                    'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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

        public function actionIndex(){
            return $this->render('index');
        }

        public function actionLogin(){
            if(!Yii::$app->user->isGuest){
                return $this->goHome();
            }

            $token = Yii::$app->request->post('token');
            if(isset($token)&&User::loginByToken($token)){
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


        public function actionAbout(){
            return $this->render('about');
        }
    }
