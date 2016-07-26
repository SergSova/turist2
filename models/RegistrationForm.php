<?php

    namespace app\models;

    use app\models\User;
    use Yii;
    use yii\base\Model;

    class RegistrationForm extends Model{

        public $username;
        public $email;
        public $access_token;
        public $password;
        public $confirmation;
        public $f_name;
        public $l_name;

        public function register(){
            if($this->validate()){
                $user = new User();
                $token = Yii::$app->request->post('token');
                if(!isset($token)){
                    $this->access_token = $token;
                    $s = file_get_contents('http://ulogin.ru/token.php?token='.$this->access_token.'&host='.Yii::$app->basePath);
                    $token_user = json_decode($s, true);

                    $this->password = Yii::$app->security->generatePasswordHash($token_user['identity']);
                    $this->email = $token_user['email'];
                    $this->username = $token_user['first_name'].$token_user['last_name'];
                    $this->f_name = $token_user['first_name'];
                    $this->l_name = $token_user['last_name'];

                    //$token_user['network'] - соц. сеть, через которую авторизовался пользователь
                    //$token_user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
                    //$token_user['first_name'] - имя пользователя
                    //$token_user['last_name'] - фамилия пользователя

                }
                $user->load($this);
                if($user->save(false)){
                    return $user;
                }
            }

            return null;
        }
    }

