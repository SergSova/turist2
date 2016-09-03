<?php

    namespace app\models;

    use Yii;

    /**
     * This is the model class for table "tur_event_type".
     *
     * @property integer $id
     * @property string  $name
     *
     * @property Event[] $events
     */
    class EventType extends \yii\db\ActiveRecord{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return 'tur_event_type';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    ['name'],
                    'string',
                    'max' => 50
                ],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id' => 'ID',
                'name' => 'Name',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getEvents(){
            return $this->hasMany(Event::className(), ['event_type_id' => 'id']);
        }
    }
