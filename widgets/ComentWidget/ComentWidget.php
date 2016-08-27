<?php

    namespace app\widgets\ComentWidget;

    use app\models\Coments;
    use yii\base\Widget;

    class ComentWidget extends Widget{
        public $model_id;

        public function run(){
            $modelComent = Coments::findAll(['event_id' => $this->model_id]);

            return $this->render('coment', ['modelComent' => $modelComent]);
        }

    }