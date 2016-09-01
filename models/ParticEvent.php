<?php

    namespace app\models;

    use Yii;

    /**
     * This is the model class for table "tur_partic_event".
     *
     * @property integer $id
     * @property integer $user_id
     * @property integer $event_id
     * @property boolean $confirmed
     * @property string  $confirmedtext
     *
     * @property Event   $event
     * @property User   $user
     */
    class ParticEvent extends \yii\db\ActiveRecord{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return 'tur_partic_event';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [['user_id', 'event_id'], 'integer'],
                [['confirmed'], 'boolean'],
                [['confirmedtext'], 'string'],
                [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
                [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
                [['user_id', 'event_id'], 'uniquePara']
            ];
        }

        public function scenarios(){
            return ['default'=>['confirmed']];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'       => 'ID',
                'user_id'  => 'User ID',
                'event_id' => 'Event ID',
                'confirmedtext'=>'Запрос на подтверждение'
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getEvent(){
            return $this->hasOne(Event::className(), ['id' => 'event_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getUser(){
            return $this->hasOne(User::className(), ['id' => 'user_id']);
        }

        public function uniquePara($attribute){
            if(self::find()
                   ->where(['event_id' => $this->event_id])
                   ->andWhere(['user_id' => $this->user_id])
                   ->exists()
            ){
                $this->addError($attribute, 'уже есть такая пара пользователь событие');
            }
        }
    }
