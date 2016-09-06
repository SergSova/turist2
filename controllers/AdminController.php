<?php

    namespace app\controllers;

    use app\models\Condition;
    use Yii;
    use yii\web\Controller;

    class AdminController extends Controller{


        //region Condition CRUD
        public function actionIndexCondition(){
            $model = Condition::find()
                              ->all();

            return $this->render('condition/index', ['model' => $model]);
        }

        public function actionCreateCondition(){
            $model = new Condition();
            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->goBack();
            }

            return $this->render('condition/create', ['model' => $model]);
        }

        public function actionUpdateCondition($id){
            $model = Condition::findOne($id);

            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->goBack();
            }

            return $this->render('condition/create', ['model' => $model]);
        }

        public function actionDeleteCondition($id){
            Condition::findOne($id)
                     ->delete();

            return $this->goBack();
        }
        //endregion

        //region OrganizatorRole CRUD
        public function actionIndexOrgRole(){
            $model = Condition::find()
                              ->all();

            return $this->render('org_role/index', ['model' => $model]);
        }

        public function actionCreateOrgRole(){
            $model = new Condition();
            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->goBack();
            }

            return $this->render('org_role/create', ['model' => $model]);
        }

        public function actionUpdateOrgRole($id){
            $model = Condition::findOne($id);

            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->goBack();
            }

            return $this->render('org_role/create', ['model' => $model]);
        }

        public function actionDeleteOrgRole($id){
            Condition::findOne($id)
                     ->delete();

            return $this->goBack();
        }
        //endregion



    }