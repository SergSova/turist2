<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tur_org_role".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 */
class OrgRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%org_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Роль',
            'desc' => 'Описание',
        ];
    }
}
