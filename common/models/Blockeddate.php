<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
* This is the model class for table "{{%vendor_blocked_date}}".
*
* @property string $block_id
* @property string $vendor_id
* @property string $block_date
* @property integer $created_by
* @property integer $modified_by
* @property string $created_datetime
* @property string $modified_datetime
* @property string $trash
*/
class Blockeddate extends \yii\db\ActiveRecord
{
    /**
    * @inheritdoc
    */
    public $sunday,$monday,$tuesday,$wednesday,$thursday,$friday,$saturday;
    public static function tableName()
    {
        return '{{%vendor_blocked_date}}';
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
            [['vendor_id', 'block_date'], 'required',],
            ['block_date', 'createblockvalidation','on' => 'insert',],
            ['block_date','blockvalidation','on' => 'update',],

            //  [['block_date'],'unique'],
            [['vendor_id', 'created_by', 'modified_by'], 'integer'],
            [['created_by', 'modified_by', 'created_datetime', 'modified_datetime'], 'safe'],
            [['trash','sunday','monday','tuesday','wednesday','thursday','friday','saturday'], 'string']
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'block_id' => 'Block ID',


            'vendor_id' => 'Vendor ID',
            'block_date' => 'Block Date',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'created_datetime' => 'Created Datetime',
            'modified_datetime' => 'Modified Datetime',
            'trash' => 'Trash',
        ];
    }

    public  function blockvalidation($attribute_name,$params)
    {
        if(!empty($this->block_date) ){
            //echo '111';die;
            $block_date= date ("Y-m-d",strtotime("0 day", strtotime($this->block_date)));


            $model = Blockeddate::find()
            ->where(['block_date'=>$block_date])
            ->andwhere(['!=','block_id',$this->block_id])
            ->one();
            if($model){
                $this->addError('block_date','Block date "'.$this->block_date.'" has already been taken');
            }

        }
    }



    public  function createblockvalidation($attribute_name,$params)
    {
        if(!empty($this->block_date) ){
            $block_date= date ("Y-m-d",strtotime("0 day", strtotime($this->block_date)));


            $model = Blockeddate::find()
            ->where(['block_date'=>$block_date])
            ->one();
            if($model){
                $this->addError('block_date','Block date "'.$this->block_date.'" has already been taken');
            }

        }
    }
}
