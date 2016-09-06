<?php

    namespace app\controllers;

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
            return $this->render('index');
        }

        public function actionMap(){
            return $this->render('map');
        }
    }
