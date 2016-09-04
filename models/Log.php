<?php

    namespace app\models;

    use Yii;
    use yii\helpers\Json;

    /**
     * This is the model class for table "tur_log".
     *
     * @property integer $id
     * @property string  $date
     * @property integer $user_id
     * @property string  $action
     * @property string  $table
     * @property string  $blob
     *
     * @property User    $user
     */
    class Log extends \yii\db\ActiveRecord{
        /**
         * @inheritdoc
         */
        public static function tableName(){
            return 'tur_log';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    ['date'],
                    'safe'
                ],
                [
                    ['user_id'],
                    'integer'
                ],
                [
                    'action',
                    'string',
                    'max' => 150
                ],
                [
                    ['table'],
                    'string',
                    'max' => 50
                ],
                [
                    ['blob'],
                    'string',
                    'max' => 255
                ],
                //            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id' => 'ID',
                'date' => 'Date',
                'user_id' => 'User ID',
                'action' => 'Action',
                'table' => 'Table',
                'blob' => 'Blob',
            ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getUser(){
            return $this->hasOne(User::className(), ['id' => 'user_id']);
        }

        /**
         * @param Event $event
         */
        public static function addLog($event){
            $model = new self();
            //        $senderName = ($event->sender)::className();
            $model->attributes = [
                'action' => $event->name,
                'table' => $event->data['name'],
                'user_id' => Yii::$app->user->isGuest ? -1 : Yii::$app->user->id,
                'blob' => $event->data ? Json::encode($event->data) : '',
            ];
            if($model->save()){
                $f = 1;
            }else{
                $f = 2;
            }
        }
    }
