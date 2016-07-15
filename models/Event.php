<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tur_event".
 *
 * @property integer $id
 * @property integer $event_type_id
 * @property integer $creator_id
 * @property string $title
 * @property string $photo
 * @property string $desc
 * @property string $organizators
 * @property string $particip
 * @property string $condition
 * @property string $date_start
 * @property string $date_end
 * @property string $date_creation
 * @property string $status
 * @property integer $rate
 *
 * @property Coments[] $coments
 * @property EventType $eventType
 * @property User $creator
 * @property ParticEvent[] $particEvents
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tur_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_type_id', 'creator_id', 'rate'], 'integer'],
            [['photo', 'desc', 'organizators', 'particip', 'condition', 'status'], 'string'],
            [['date_start', 'date_end', 'date_creation'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['event_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventType::className(), 'targetAttribute' => ['event_type_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_type_id' => 'Event Type ID',
            'creator_id' => 'Creator ID',
            'title' => 'Title',
            'photo' => 'Photo',
            'desc' => 'Desc',
            'organizators' => 'Organizators',
            'particip' => 'Particip',
            'condition' => 'Condition',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'date_creation' => 'Date Creation',
            'status' => 'Status',
            'rate' => 'Rate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComents()
    {
        return $this->hasMany(Coments::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventType()
    {
        return $this->hasOne(EventType::className(), ['id' => 'event_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticEvents()
    {
        return $this->hasMany(ParticEvent::className(), ['event_id' => 'id']);
    }
}
