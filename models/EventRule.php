<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%event_rule}}".
 *
 * @property integer $id
 * @property string $name
 */
class EventRule extends \yii\db\ActiveRecord
{
    const ALL = 2;
    const PHOTO = 1;
    const PARTICIPIANT = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event_rule}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}
