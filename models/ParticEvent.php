<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tur_partic_event".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $event_id
 * @property integer $confirmed
 * @property string $confirmedtext
 *
 * @property Event $event
 * @property User $user
 */
class ParticEvent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tur_partic_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'event_id', 'confirmed'], 'integer'],
            [['confirmedtext'], 'string'],
            [['user_id', 'event_id'], 'unique', 'targetAttribute' => ['user_id', 'event_id'], 'message' => 'Вы уже зарегистрированы'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'event_id' => 'Event ID',
            'confirmed' => 'Confirmed',
            'confirmedtext' => 'Confirmedtext',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
