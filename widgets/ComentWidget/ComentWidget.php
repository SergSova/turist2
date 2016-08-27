<?php

    namespace app\widgets\ComentWidget;

    use app\models\Coments;
    use yii\base\Widget;
    use yii\data\ActiveDataProvider;

    class ComentWidget extends Widget{
        public $model_id;

        public function run(){
            $comentQuery = Coments::find()->where(['event_id' => $this->model_id]);
            $dataProvider = new ActiveDataProvider(['query'=>$comentQuery]);

            return $this->render('coment', ['dataProvider' => $dataProvider]);
        }

    }