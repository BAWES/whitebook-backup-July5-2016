<?php

namespace backend\models;

/**
 * This is the model class for table "{{%auth_rule}}".
 *
 * @property string $name
 * @property string $data
 * @property int $created_at
 * @property int $updated_at
 * @property AuthItem[] $authItems
 */
class Authrule extends \yii\db\ActiveRecord
{
    /**
      * {@inheritdoc}
      */
     public $created_datetime;
    public static function tableName()
    {
        return '{{%auth_rule}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_datetime', 'modified_datetime'], 'safe'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItems()
    {
        return $this->hasMany(AuthItem::className(), ['rule_name' => 'name']);
    }
}