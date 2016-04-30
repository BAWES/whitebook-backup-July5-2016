<?php

namespace backend\models;

use Yii;

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
class Blockeddate extends \common\models\Blockeddate
{

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
