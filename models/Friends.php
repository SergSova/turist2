<?php

    namespace app\models;

    use app\models\search\FriendsSearch;
    use app\models\search\UserSearch;
    use Yii;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;

    /**
     * This is the model class for table "tur_friends".
     *
     * @property integer $id
     * @property integer $user_id
     * @property integer $friend_id
     *
     * @property User    $friend
     * @property User    $user
     */
    class Friends extends \yii\db\ActiveRecord{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return 'tur_friends';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'user_id',
                        'friend_id'
                    ],
                    'integer'
                ],
                [
                    ['friend_id'],
                    'exist',
                    'skipOnError' => true,
                    'targetClass' => User::className(),
                    'targetAttribute' => ['friend_id' => 'id']
                ],
                [
                    ['user_id'],
                    'exist',
                    'skipOnError' => true,
                    'targetClass' => User::className(),
                    'targetAttribute' => ['user_id' => 'id']
                ],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id' => 'ID',
                'user_id' => 'User ID',
                'friend_id' => 'Friend ID',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getFriend(){
            return $this->hasOne(User::className(), ['id' => 'friend_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getUser(){
            return $this->hasOne(User::className(), ['id' => 'user_id']);
        }


        public function getAllUsers(){
            return ArrayHelper::map(\app\models\User::find()
                                                    ->all(), 'id', 'username');
        }

        public static function getAllFriendArrayId(){
            return self::find()
                       ->filterWhere(['user_id' => Yii::$app->user->id])
                       ->asArray()
                       ->all();
        }

        public function addFriend($userId){
            $this->friend_id = $userId;
            $this->save();
        }

    }
