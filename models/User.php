<?php

    namespace app\models;

    use app\components\Logging\Logging;
    use Yii;
    use yii\sergsova\fileManager\FileManager;
    use yii\bootstrap\Html;
    use yii\web\IdentityInterface;

    /**
     * This is the model class for table "tur_user".
     *
     * @property integer       $id
     * @property string        $username
     * @property string        $password
     * @property string        $auth_key
     * @property string        $password_reset_token
     * @property string        $status
     * @property string        $email
     * @property string        $access_token
     * @property string        $created_at
     * @property integer       $rate
     * @property string        $f_name
     * @property string        $l_name
     * @property string        $photo
     *
     * @property Comments[]    $comments
     * @property Event[]       $events
     * @property Friends[]     $friends
     * @property Friends[]     $friends0
     * @property Log[]         $logs
     * @property ParticEvent[] $particEvents
     * @property SocialAcc[]   $socialAccs
     * @property Vote[]        $votes
     * @property EventUserRule[] $eventUserRules
     */
    class User extends \yii\db\ActiveRecord implements IdentityInterface{
        const STATUS_INACTIVE = 'INACTIVE';
        const STATUS_ACTIVE   = 'ACTIVE';
        const STATUS_BLOCKED  = 'BLOCKED';

        public function init(){
            parent::init();
        }

        /**
         * @inheritdoc
         */
        public static function tableName(){
            return 'tur_user';
        }

        public function afterFind(){
            $comment = $this->getComments()
                            ->sum('rate');
            $event = $this->getEvents()
                          ->sum('rate');
            $this->rate = $comment + $event;
        }


        public static function findByUsername($username){
            return self::findOne(['username' => $username]);
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    ['username'],
                    'required'
                ],
                [
                    ['status'],
                    'string'
                ],
                [
                    [
                        'created_at',
                        'password_reset_token'
                    ],
                    'safe'
                ],
                [
                    ['rate'],
                    'integer'
                ],
                [
                    [
                        'username',
                        'email',
                        'f_name',
                        'l_name'
                    ],
                    'string',
                    'max' => 50
                ],
                [
                    [
                        'password',
                        'auth_key',
                        'access_token',
                        'photo'
                    ],
                    'string',
                    'max' => 255
                ],
                [
                    ['username'],
                    'unique'
                ],
                [
                    ['email'],
                    'unique'
                ],
            ];
        }


        public function scenarios(){
            $scenarios = parent::scenarios();
            $scenarios['photo'] = ['photo'];

            return $scenarios;
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id' => 'ID',
                'username' => 'Username',
                'password' => 'Password',
                'auth_key' => 'Auth Key',
                'status' => 'Status',
                'email' => 'Email',
                'access_token' => 'Access Token',
                'created_at' => 'Created At',
                'rate' => 'Рейтинг',
                'f_name' => 'Фамилия',
                'l_name' => 'Имя',
                'photo' => 'Фото',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getComments(){
            return $this->hasMany(Comments::className(), ['user_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getEvents(){
            return $this->hasMany(Event::className(), ['creator_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getFriends(){
            return $this->hasMany(Friends::className(), ['friend_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getEventUserRule(){
            return $this->hasOne(EventUserRule::className(), ['eventId' => 'id']);
        }
        
        /**
         * @return \yii\db\ActiveQuery
         */
        public function getFriends0(){
            return $this->hasMany(Friends::className(), ['user_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getLogs(){
            return $this->hasMany(Log::className(), ['user_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getParticEvents(){
            return $this->hasMany(ParticEvent::className(), ['user_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getSocialAccs(){
            return $this->hasMany(SocialAcc::className(), ['user_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getVotes(){
            return $this->hasMany(Vote::className(), ['user_id' => 'id']);
        }

        /**
         * Finds an identity by the given ID.
         *
         * @param string|integer $id the ID to be looked for
         *
         * @return IdentityInterface the identity object that matches the given ID.
         * Null should be returned if such an identity cannot be found
         * or the identity is not in an active state (disabled, deleted, etc.)
         */
        public static function findIdentity($id){
            return self::findOne($id);
        }

        /**
         * Finds an identity by the given token.
         *
         * @param mixed $token the token to be looked for
         * @param mixed $type  the type of the token. The value of this parameter depends on the implementation.
         *                     For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
         *
         * @return IdentityInterface the identity object that matches the given token.
         * Null should be returned if such an identity cannot be found
         * or the identity is not in an active state (disabled, deleted, etc.)
         */
        public static function findIdentityByAccessToken($token, $type = null){
            return self::findOne(['access_token' => $token]);
        }

        /**
         * Returns an ID that can uniquely identify a user identity.
         * @return string|integer an ID that uniquely identifies a user identity.
         */
        public function getId(){
            return $this->id;
        }

        /**
         * Returns a key that can be used to check the validity of a given identity ID.
         *
         * The key should be unique for each individual user, and should be persistent
         * so that it can be used to check the validity of the user identity.
         *
         * The space of such keys should be big enough to defeat potential identity attacks.
         *
         * This is required if [[User::enableAutoLogin]] is enabled.
         * @return string a key that is used to check the validity of a given identity ID.
         * @see validateAuthKey()
         */
        public function getAuthKey(){
            return $this->auth_key;
        }

        /**
         * Validates the given auth key.
         *
         * This is required if [[User::enableAutoLogin]] is enabled.
         *
         * @param string $authKey the given auth key
         *
         * @return boolean whether the given auth key is valid.
         * @see getAuthKey()
         */
        public function validateAuthKey($authKey){
            return $this->auth_key === $authKey;
        }

        /**
         * Validates password
         *
         * @param string $password password to validate
         *
         * @return boolean if password provided is valid for current user
         */
        public function validatePassword($password){
            return Yii::$app->security->validatePassword($password, $this->password);
        }

        public static function isPasswordResetTokenValid($password_reset_token){
            if(empty($token)){
                return false;
            }

            $timestamp = (int)substr($token, strrpos($token, '_') + 1);
            $expire = Yii::$app->params['user.passwordResetTokenExpire'];

            return $timestamp + $expire >= time();
        }

        public function registration(){

            $this->status = self::STATUS_INACTIVE;

            // нужно добавить следующие три строки:
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('user');
            $auth->assign($authorRole, $this->getId());
        }

        public function setPassword($password){
            $this->password = Yii::$app->security->generatePasswordHash($password);
        }

        public static function loginByToken($token){
            $s = file_get_contents('http://ulogin.ru/token.php?token='.$token.'&host='.Yii::$app->basePath);
            $token_user = json_decode($s, true);
            $transaction = Yii::$app->db->beginTransaction();
            try{
                if(!Yii::$app->user->isGuest){
                    $user = Yii::$app->user->identity;
                }else{
                    $user = self::findOne(['email' => $token_user['email']]);
                }
                if(is_null($user)){
                    $user = new self();
                    $user->access_token = $token_user['identity'];
                    $user->email = $token_user['email'];
                    $user->username = $token_user['first_name'].' '.$token_user['last_name'];
                    $user->f_name = $token_user['first_name'];
                    $user->l_name = $token_user['last_name'];
                    $user->status = self::STATUS_ACTIVE;
                    $user->setPassword('0');
                    $user->photo = json_encode([$token_user['photo_big']]);

                    if(!$user->save()){
                        throw new \Exception('ошибка сохранения user');
                    }
                    $auth = Yii::$app->authManager;
                    $authorRole = $auth->getRole('user');
                    $auth->assign($authorRole, $user->getId());

                    self::addSocial($user, $token_user);
                }else{
                    if(!$user->getSocialAccs()
                             ->where(['social_name' => $token_user['network']])
                             ->exists()
                    ){
                        self::addSocial($user, $token_user);
                    }
                }
                $transaction->commit();
            }catch(\Exception $e){
                $transaction->rollBack();
            }
            /** @var User $user */
            if(!$user->hasErrors()){
                return Yii::$app->user->login($user, 3600 * 24 * 30);
            }

            return false;
        }

        /**
         * @param $user
         * @param $token_user
         *
         * @throws \Exception
         */
        private static function addSocial($user, $token_user){
            $social = new SocialAcc();
            $social->user_id = $user->id;
            $social->social_id = $token_user['identity'];
            $social->social_name = $token_user['network'];
            if(!$user->photo && $token_user['photo_big']){
                $user->photo = json_encode([$token_user['photo_big']]);
            }
            if(!$social->save()){
                throw new \Exception('ошибка сохранения social');
            }
        }

        public function beforeSave($insert){
            if(parent::beforeSave($insert)){
                if($this->isNewRecord){
                    $this->auth_key = Yii::$app->security->generateRandomString();
                    $this->created_at = date("Y-m-d H:i:s");
                    $this->rate = 0;
                }

                return true;
            }

            return false;
        }

        public function getPhoto(){
            if(json_decode($this->photo) == []){
                return '';
            }
            $user_photo = json_decode($this->photo);
            $photo = explode('/', $user_photo[0]);

            return $photo[0] == 'http:' ? $user_photo[0] : FileManager::getInstance()
                                                                      ->getStorageUrl().$user_photo[0];
        }

        public function generatePasswordResetToken(){
            $this->password_reset_token = Yii::$app->security->generateRandomString();
        }

        public static function changeEmail($token, $newEmail){
            $user = self::findOne(['password_reset_token' => $token]);
            if(!$user){
                return false;
            }
            $user->email = $newEmail;
            if($user->save()){
                return true;
            }

            return false;
        }
    }
