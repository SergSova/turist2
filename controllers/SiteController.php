<?php

    namespace app\controllers;

    use app\models\Event;
    use app\models\search\EventSearch;
    use yii\web\Controller;

    class SiteController extends Controller{

        public function actions(){
            return [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ]
            ];
        }


        public function actionIndex(){
            $params = [
                'date_start' => date('Y-m-d'),
                'status' => Event::STATUS_ACTIVE
            ];
            $model = (new EventSearch())->search($params);
            return $this->render('index', ['model'=>$model]);
        }

        public function actionMap(){
            return $this->render('map');
        }

        public function actionLogin(){
            return $this->redirect('/web/user/login');
        }
    }
