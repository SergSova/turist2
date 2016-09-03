<?php

    namespace app\models;

    use Yii;

    /**
     * This is the model class for table "tur_vote".
     *
     * @property integer $id
     * @property integer $user_id
     * @property string  $model_name
     * @property integer $model_id
     * @property string  $rate_type
     *
     * @property User    $user
     */
    class Vote extends \yii\db\ActiveRecord{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return 'tur_vote';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'user_id',
                        'model_name',
                        'model_id',
                        'rate_type'
                    ],
                    'required'
                ],
                [
                    [
                        'user_id',
                        'model_id'
                    ],
                    'integer'
                ],
                [
                    ['model_name'],
                    'string',
                    'max' => 25
                ],
                [
                    ['rate_type'],
                    'string',
                    'max' => 5
                ],
                [
                    [
                        'user_id',
                        'model_name',
                        'model_id'
                    ],
                    'unique',
                    'targetAttribute' => [
                        'user_id',
                        'model_name',
                        'model_id'
                    ],
                    'message' => 'Вы уже проголосовали'
                ],
                [
                    ['user_id'],
                    'exist',
                    'skipOnError' => true,
                    'targetClass' => User::className(),
                    'targetAttribute' => ['user_id' => 'id']
                ],
                [
                    [
                        'model_name',
                        'user_id',
                        'model_id'
                    ],
                    'validParticip'
                ]
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id' => 'ID',
                'user_id' => 'User ID',
                'model_name' => 'Model Name',
                'model_id' => 'Model ID',
                'rate_type' => 'Rate Type',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getUser(){
            return $this->hasOne(User::className(), ['id' => 'user_id']);
        }

        public function validParticip($attributes){
            if($this->model_name == 'event'){
                if(!ParticEvent::find()
                               ->where([
                                           'user_id' => $this->user_id,
                                           'event_id' => $this->model_id
                                       ])
                               ->exists()
                ){
                    $this->addError($attributes, 'вы не участвовали в событии');
                }
            }
        }
    }
