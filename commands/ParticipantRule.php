<?php

    namespace app\commands;

    use app\models\Event;
    use yii\rbac\Item;
    use yii\rbac\Rule;

    class ParticipantRule extends Rule{
        public $name = 'isParticipant';
        /**
         * Executes the rule.
         *
         * @param string|integer $user   the user ID. This should be either an integer or a string representing
         *                               the unique identifier of a user. See [[\yii\web\User::id]].
         * @param Item           $item   the role or permission that this rule is associated with
         * @param array          $params parameters passed to [[CheckAccessInterface::checkAccess()]].
         *
         * @return boolean a value indicating whether the rule permits the auth item it is associated with.
         */
        public function execute($user, $item, $params){
            return $params['event']->getParticEvents()->where(['user_id'=>$user])->exists();
        }}