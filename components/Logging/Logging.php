<?php
    /**
     * Created by PhpStorm.
     * User: sergey
     * Date: 01.09.16
     * Time: 15:46
     */

    namespace app\components\Logging;

    use app\models\Log;

    class Logging{
        const EVENT_ADD_LOG = 'addLog';

        public function addLog($event){
            Log::addLog($event);
        }
    }