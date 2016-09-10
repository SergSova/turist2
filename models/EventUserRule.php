<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tur_event_user_rule".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $ruleId
 * @property integer $eventId
 *
 * @property EventRule $rule
 * @property Event $event
 * @property User $user
 */
class EventUserRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tur_event_user_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'ruleId', 'eventId'], 'integer'],
            [['userId', 'eventId'], 'unique', 'targetAttribute' => ['userId', 'eventId'], 'message' => 'The combination of User ID and Event ID has already been taken.'],
            [['ruleId'], 'exist', 'skipOnError' => true, 'targetClass' => EventRule::className(), 'targetAttribute' => ['ruleId' => 'id']],
            [['eventId'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['eventId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'ruleId' => 'Rule ID',
            'eventId' => 'Event ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRule()
    {
        return $this->hasOne(EventRule::className(), ['ruleId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['eventId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'id']);
    }
}
