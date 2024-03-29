<?php

namespace admin\models;

use admin\models\Usercontroller;
use admin\models\Admin;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
* This is the model class for table "{{%access_control}}".
*
* @property integer $access_id
* @property string $role_id
* @property string $admin_id
* @property integer $created_by
* @property integer $modified_by
* @property string $created_datetime
* @property string $modified_datetime
*
* @property Admin $admin
* @property Role $role
*/
class Accesscontroller extends \yii\db\ActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return '{{%access_control}}';
    }


    /*
    *
    *   To save created, modified user & date time
    */
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
            // [['create','update','delete','manage','view'], 'required'],
            [['admin_id','controller',], 'required'],
            [['role_id'], 'integer'],
            [['admin_id'], 'string'],
            [['created_datetime', 'modified_datetime'], 'safe'],
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'access_id' => 'Access User',
            'role_id' => 'Roles',
            'controller' => 'Controller',
            'admin_id' => 'User',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'created_datetime' => 'Created Datetime',
            'modified_datetime' => 'Modified Datetime',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public static function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'admin_id']);
    }




    public static function getAdminName($id)
    {
        $admin= Admin::find()
        ->select ('admin_name')
        ->where(['=', 'id', $id])
        ->one();
        return ($admin['admin_name']);
    }
    public static function getControllerName($id)
    {
        $controller= Usercontroller::find()
        ->select ('controller')
        ->where(['=', 'id', $id])
        ->one();
        return ($controller['controller']);
    }

    public static function itemcontroller($ctrllist)
    {
        $k=explode(",",$ctrllist);

        $g=array();
        foreach ($k as $f)
        {
            $controller= Usercontroller::find()
            ->select ('controller')
            ->where(['=', 'id', $f])
            ->one();
            $g[]=$controller;
        }
        $m=array();
        foreach ($g as $r)
        {
            $m[]= $r['controller'];
        }
        return implode(" , ",$m);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['role_id' => 'role_id']);
    }
}
