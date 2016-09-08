<?php

    namespace app\widgets\rateCounter;

    use yii\base\Widget;

    class rateCounterWidget extends Widget{
        public $rate;
        public $params;
        public $action_vote;

        public function init(){
            parent::init();
            $this->params = [
                'rate' => $this->rate,
                'action_vote' => $this->action_vote,
            ];
        }

        public function run(){
            return $this->render('_rate', ['params' => $this->params]);
        }
    }