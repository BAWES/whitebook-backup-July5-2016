<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "{{%events}}".
 *
 * @property integer $event_id
 * @property integer $customer_id
 * @property string $event_name
 * @property string $event_date
 * @property string $event_type
 * @property string $created_date
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%events}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'event_name', 'event_date', 'event_type'], 'required'],
            [['customer_id'], 'integer'],
            [['event_date', 'created_date'], 'safe'],
            [['event_name', 'event_type'], 'string', 'max' => 100],
        ];
    }

        public function behaviors()
    {
          return [
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'event_id' => 'Event ID',
            'customer_id' => 'Customer ID',
            'event_name' => 'Event Name',
            'event_date' => 'Event Date',
            'event_type' => 'Event Type',
            'created_date' => 'Created Date',
        ];
    }
}
