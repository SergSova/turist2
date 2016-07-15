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
        public $confirmpassword;

        public function registr($token = null){
            if($this->validate()){
                $user = new User();
                if(!is_null($token)){
                    $this->access_token = $token;
                    $s = file_get_contents('http://ulogin.ru/token.php?token='.$this->access_token.'&host='.Yii::$app->basePath);
                    $token_user = json_decode($s, true);

                    $this->email = $token_user['first_name'].$token_user['last_name'];
                    $this->username = $token_user['email'];
                    $user->f_name = $token_user['first_name'];
                    $user->l_name = $token_user['last_name'];
                    $user->status = 'active';


                    //$token_user['network'] - соц. сеть, через которую авторизовался пользователь
                    //$token_user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
                    //$token_user['first_name'] - имя пользователя
                    //$token_user['last_name'] - фамилия пользователя

                }else{
                    $user->username = $this->username;
                    $user->setPassword($this->password);
                    $user->email = $this->email;
                }
                $user->save(false);

                // нужно добавить следующие три строки:
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('user');
                $auth->assign($authorRole, $user->getId());

                return $user;
            }

            return null;
        }
    }

