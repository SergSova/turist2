<?php

    namespace app\components\Logging;

    use yii\base\Event;

    class Logging{

        public function __construct(){
            $event = new \app\models\Event();

        }

        public function init(){
            $event = new \app\models\Event();
            $event->on(\app\models\Event::EVENT_BEFORE_INSERT, [$this, 'addCommentLog']);
        }

        protected function addCommentLog(Event $event){
            $data = array_merge($event->data, [
                $event->sender->class_name() => $event->sender->id
            ]);
            Log::addLog($event->name, $data);
        }

    }