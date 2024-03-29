<?php

namespace common\models;
use yii\helpers\ArrayHelper;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
* This is the model class for table "{{%area}}".
*
* @property string $area_id
* @property integer $area_name
* @property integer $created_by
* @property integer $modified_by
* @property string $created_datetime
* @property string $modified_datetime
* @property string $trash
*/
class Vendoraddress extends \yii\db\ActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'whitebook_vendor_address';
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'modified_by',
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_datetime',
                'updatedAtAttribute' => 'modified_datetime',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['vendor_contact_no','address_text','area_id'], 'required'],
            [['created_by', 'modified_by'], 'integer'],
            [['created_datetime', 'modified_datetime'], 'safe'],
            [['trash'], 'string']
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'created_datetime' => 'Created Datetime',
            'modified_datetime' => 'Modified Datetime',
            'trash' => 'Trash',
            'area_id' => 'Area',
            'vendor_contact_no' => 'Contact number',
        ];
    }

    public static function loadaddress()
    {
        $address=Vendoraddress::find()->all();
        return $address=ArrayHelper::map($area,'address_id','address_text');
    }


    public static function areashow($id)
    {
        echo $id;
        $area=Area::find()->select('area_name')
        ->where(['area_id'=> $id])
        ->asArray()
        ->all();
        return ($area[0]['area_name']);
    }

}
