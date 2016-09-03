<?php

    namespace app\models;

    use Yii;

    /**
     * This is the model class for table "tur_comments".
     *
     * @property integer $id
     * @property integer $event_id
     * @property integer $user_id
     * @property string  $text
     * @property integer $rate
     *
     * @property User    $user
     * @property Event   $event
     */
    class Comments extends \yii\db\ActiveRecord{
        const ACTION_COMMENT_ADD    = 10;
        const ACTION_COMMENT_EDIT   = 11;
        const ACTION_COMMENT_DELETE = 12;

        /**
         * @inheritdoc
         */
        public static function tableName(){
            return 'tur_comments';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'event_id',
                        'user_id',
                        'rate'
                    ],
                    'integer'
                ],
                [
                    ['text'],
                    'string'
                ],
                [
                    ['user_id'],
                    'exist',
                    'skipOnError' => true,
                    'targetClass' => User::className(),
                    'targetAttribute' => ['user_id' => 'id']
                ],
                [
                    ['event_id'],
                    'exist',
                    'skipOnError' => true,
                    'targetClass' => Event::className(),
                    'targetAttribute' => ['event_id' => 'id']
                ],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id' => 'ID',
                'event_id' => 'Event ID',
                'user_id' => 'User ID',
                'text' => 'Коментарий',
                'rate' => 'Rate',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getUser(){
            return $this->hasOne(User::className(), ['id' => 'user_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getEvent(){
            return $this->hasOne(Event::className(), ['id' => 'event_id']);
        }

        protected function addCommentLog($action, $data = []){
            $data = array_merge($data, [
                'comment_id' => $this->id
            ]);
            Log::addLog($action, $data);
        }

        public function afterSave($insert, $changedAttributes){
            if($insert){
                $this->addCommentLog(self::ACTION_COMMENT_ADD);
            }else{
                $this->addCommentLog(self::ACTION_COMMENT_EDIT, [
                    'diff' => [
                        'new' => $changedAttributes,
                        'old' => ''
                    ]
                ]);
            }
            parent::afterSave($insert, $changedAttributes);
        }
    }
