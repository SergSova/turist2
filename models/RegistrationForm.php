<?php

    namespace app\models;

    use Yii;
    use yii\base\Model;
    use yii\web\UploadedFile;

    class RegistrationForm extends Model{

        public $username;
        public $email;
        public $access_token;
        public $password;
        public $password_repeat;
        public $f_name;
        public $l_name;
        public $photo;

        public function rules(){
            return [
                [['username', 'password', 'email'], 'required'],
                ['photo','safe'],
                [['username'], 'unique', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
                [['email'], 'unique', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['email' => 'email']],
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
                $user->status = User::STATUS_INACTIVE;
                $user->photo = json_encode($this->photo);

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

