<?php

    namespace app\models;

    use Yii;
    use yii\web\IdentityInterface;

    /**
     * This is the model class for table "tur_user".
     *
     * @property integer       $id
     * @property string        $username
     * @property string        $password
     * @property string        $auth_key
     * @property string        $status
     * @property string        $email
     * @property string        $access_token
     * @property string        $created_at
     * @property integer       $rate
     * @property string        $f_name
     * @property string        $l_name
     *
     * @property Coments[]     $coments
     * @property Event[]       $events
     * @property Friends[]     $friends
     * @property Friends[]     $friends0
     * @property Log[]         $logs
     * @property ParticEvent[] $particEvents
     */
    class User extends \yii\db\ActiveRecord implements IdentityInterface{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return 'tur_user';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [['status'], 'string'],
                [['created_at'], 'safe'],
                [['rate'], 'integer'],
                [['username', 'email', 'f_name', 'l_name'], 'string', 'max' => 50],
                [['password', 'auth_key', 'access_token'], 'string', 'max' => 255],
                [['email'], 'unique'],
                [['username'], 'unique'],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'           => 'ID',
                'username'     => 'Username',
                'password'     => 'Password',
                'auth_key'     => 'Auth Key',
                'status'       => 'Status',
                'email'        => 'Email',
                'access_token' => 'Access Token',
                'created_at'   => 'Created At',
                'rate'         => 'Rate',
                'f_name'       => 'F Name',
                'l_name'       => 'L Name',
            ];
        }
        public function beforeSave($insert){
            if(parent::beforeSave($insert)){
                if($this->isNewRecord){
                    $this->auth_key = \Yii::$app->security->generateRandomString();
                }

                return true;
            }

            return false;
        }

        //region Satandart func
        /**
         * @return \yii\db\ActiveQuery
         */
        public function getComents(){
            return $this->hasMany(Coments::className(), ['user_id' => 'id']);
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
         * @inheritdoc
         */
        public static function findIdentity($id){
            return self::findOne($id);
        }

        /**
         * @inheritdoc
         */
        public static function findIdentityByAccessToken($token, $type = null){
            return self::findOne(['access_token' => $token]);
        }

        /**
         * Finds user by username
         *
         * @param string $username
         *
         * @return static|null
         */
        public static function findByUsername($username){
            return self::findOne(['username' => $username]);
        }

        /**
         * @inheritdoc
         */
        public function getId(){
            return $this->id;
        }

        /**
         * @inheritdoc
         */
        public function getAuthKey(){
            return $this->auth_key;
        }

        /**
         * @inheritdoc
         */
        public function validateAuthKey($authKey){
            return $this->auth_key === $authKey;
        }
        //endregion

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

        public function registration(){
        }

        public function setPassword($password){
            $this->password = \Yii::$app->security->generatePasswordHash($password);
        }
    }
