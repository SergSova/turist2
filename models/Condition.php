<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tur_condition".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 */
class Condition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%condition}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'desc'], 'required'],
            [['desc'], 'string'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Требование',
            'desc' => 'Описание',
        ];
    }

    public static function getAllAsArray(){
        return ArrayHelper::map(self::find()->all(),'id','name');
    }
}
