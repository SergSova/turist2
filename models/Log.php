<?php

namespace app\models;

use Yii;

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
 * @property User   $user
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tur_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['user_id'], 'integer'],
            [['action', 'table'], 'string', 'max' => 50],
            [['blob'], 'string', 'max' => 255],
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
