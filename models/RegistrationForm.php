<?php

    namespace app\models;

    use Yii;
    use yii\base\Model;

    class RegistrationForm extends Model{

        public $username;
        public $email;
        public $access_token;
        public $password;
        public $password_repeat;
        public $f_name;
        public $l_name;

        public function rules(){
            return [
                [['username', 'password','email'], 'required'],
                [['email', 'password', 'password_repeat', 'username'], 'trim'],
                ['password', 'compare'],
            ];
        }


        public function register(){
            if($this->validate()){
                $user = new User();
                $user->username = $this->username;
                $user->email = $this->email;
                $user->setPassword($this->password);
                $user->f_name = $this->f_name;
                $user->l_name = $this->l_name;
                $user->status=User::STATUS_INACTIVE;

                if($user->save(false)){
                    $auth = Yii::$app->authManager;
                    $authorRole = $auth->getRole('user');
                    $auth->assign($authorRole, $user->getId());
                    return $user;
                }
            }
            return null;
        }
    }

