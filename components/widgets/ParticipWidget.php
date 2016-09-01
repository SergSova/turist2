<?php

    namespace app\components\widgets;

    use macgyer\yii2materializecss\lib\Html;
    use yii\base\Widget;

    class ParticipWidget extends Widget{
        public $message;

        public function init(){
            parent::init();
            if($this->message === null){
                $this->message = 'нет должностей';
            }
        }

        public function run(){

            if($this->message){
                $body = '';
                if(is_array($this->message->particip)){
                    foreach($this->message->particip as $item){
                        $body .= Html::label($item->name, 'user_id');
                        $body .= Html::label($item->user_id, null, ['name' => 'user_id']);
                    }
                }

                return $body;
            }

            return Html::encode($this->message);
        }
    }