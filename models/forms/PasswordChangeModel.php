<?php

    namespace app\models\forms;

    use app\models\User;
    use Yii;
    use yii\base\Model;

    class PasswordChangeModel extends Model{
        public $password;
        public $password_repeat;


        public function rules(){
            return [
                [
                    [
                        'password',
                        'password_repeat'
                    ],
                    'safe'
                ],
                [
                    'password',
                    'compare'
                ]
            ];
        }

        public function attributeLabels(){
            return [
                'password' => 'Повторите пароль',
                'password_repeat' => 'Новый пароль'
            ];
        }

        public function changePassword(){
            $user = Yii::$app->user->identity;

            if($this->validate()){
                /** @var User $user */
                $user->setPassword($this->password);
                if(!$user->save()){
                    $this->addError('password', 'Что то пошло не так');

                    return false;
                }

                return true;
            }
        }


    }