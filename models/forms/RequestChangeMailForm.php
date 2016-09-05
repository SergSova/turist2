<?php

    namespace app\models\forms;

    use app\models\User;
    use Yii;
    use yii\base\Model;

    class RequestChangeMailForm extends Model{
        public $newEmail;

        public function rules(){
            return [
                [
                    'newEmail',
                    'email'
                ]
            ];
        }

        public function sendConfirm(){
            /** @var User $user */
            $user = Yii::$app->user->identity;
            if(!$user){
                return false;
            }

            if(!User::isPasswordResetTokenValid($user->password_reset_token)){
                $user->generatePasswordResetToken();
                if(!$user->save()){
                    return false;
                }
            }

            return Yii::$app->mailer->compose([
                                                  'html' => 'request_change_mail-html',
                                                  'text' => 'request_change_mail-text',
                                              ], [
                                                  'newEmail' => $this->newEmail,
                                                  'user' => $user
                                              ])
                                    ->setFrom(Yii::$app->params['supportEmail'])
                                    ->setTo($user->email)
                                    ->setSubject('Запрос на изменение Вашей почты')
                                    ->send();
        }
    }