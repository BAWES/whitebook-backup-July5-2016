<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "{{%vendor_delivery_timeslot}}".
 *
 * @property string $timeslot_id
 * @property string $vendor_id
 * @property string $timeslot_day
 * @property string $timeslot_start_time
 * @property string $timeslot_end_time
 * @property integer $timeslot_maximum_orders
 * @property integer $created_by
 * @property integer $modified_by
 * @property string $created_datetime
 * @property string $modified_datetime
 * @property string $trash
 */
class Deliverytimeslot extends \common\models\Deliverytimeslot
{
    public static function deliverytimeslot($day)
    {
        return $time_slot = Deliverytimeslot::find()->where(['vendor_id'=>Yii::$app->user->getId(), 'timeslot_day'=>$day])->asArray()->all();;
    }


    public static function vendor_deliverytimeslot($id,$day)
    {
        return $time_slot = Deliverytimeslot::find()->where(['vendor_id'=>$id, 'timeslot_day'=>$day])->asArray()->all();;
    }

        /* 
    *
    *   To save created, modified user & date time 
    */
    public function behaviors()
    {
          return [
              [
                  'class' => SluggableBehavior::className(),
                  'attribute' => 'category_name',              
              ],
              [
                      'class' => BlameableBehavior::className(),
                      'createdByAttribute' => 'created_by',
                      'updatedByAttribute' => 'modified_by',
                  ],
                  'timestamp' => 
                  [
                      'class' => 'yii\behaviors\TimestampBehavior',
                      'attributes' => [
                       ActiveRecord::EVENT_BEFORE_INSERT => ['created_datetime'],
                       ActiveRecord::EVENT_BEFORE_UPDATE => ['modified_datetime'],
                         
                      ],
                     'value' => new Expression('NOW()'),
                  ],
          ];
    }
    
}

