<?php
namespace admin\models;

use Yii;
use yii\helpers\ArrayHelper;
use admin\models\Vendor;

class Vendoritem extends \common\models\Vendoritem
{

   /* 
    *
    *   To save created, modified user & date time 
    */
    public function beforeSave($insert)
    {
        if($this->isNewRecord)
        {
           $this->created_datetime = \yii\helpers\Setdateformat::convert(time(),'datetime');
           $this->created_by = \Yii::$app->user->identity->id;
        } 
        else {
           $this->modified_datetime = \yii\helpers\Setdateformat::convert(time(),'datetime');
           $this->modified_by = \Yii::$app->user->identity->id;
        }
           return parent::beforeSave($insert);
    }


    public static function getVendorName($id)
    {       
        $model = Vendor::find()->where(['vendor_id'=>$id])->one();
        return $model->vendor_name;
    }

    public static function vendorpriorityitemitem($id)
    {       
            $item= Vendoritem::find()
            ->select(['item_id','item_name'])
            ->where(['=', 'item_id',$id])
            ->andwhere(['trash' =>'Default','item_for_sale' =>'Yes'])
            ->all();
            $item=ArrayHelper::map($item,'item_id','item_name');
            return $item;
    }


    public static function loadsubcategoryvendoritem($subcategory)
    {       
            $item= Vendoritem::find()
            ->where(['trash' =>'Default','item_for_sale' =>'Yes','subcategory_id'=>$subcategory])
            ->all();
            $item=ArrayHelper::map($item,'item_id','item_name');
            return $item;
    }

    public static function itemcount()
    {   
        return Vendoritem::find()->where(['trash' => 'Default'])->count();
    }

    public static function itemmonthcount()
    {
        $month=date('m');
        $year=date('Y');
        return  Vendoritem::find()
        ->where(['MONTH(created_datetime)' => $month])
        ->andwhere(['YEAR(created_datetime)' => $year])
        ->count();
    } 

    public static function itemdatecount()
    {
        $date=date('d');
        $month=date('m');
        $year=date('Y');
        return  Vendoritem::find()
        ->where(['MONTH(created_datetime)' => $month])
        ->andwhere(['YEAR(created_datetime)' => $year])
        ->andwhere(['DAYOFMONTH(created_datetime)' => $date])
        ->count();
    }

    public function statusImageurl($img_status)
    {
        if($img_status == 'Active')     
        return \yii\helpers\Url::to('@web/uploads/app_img/active.png');
        return \yii\helpers\Url::to('@web/uploads/app_img/inactive.png');
    }

    // Status Image title
    public function statusTitle($status)
    {           
    if($status == 'Active')     
        return 'Activate';
        return 'Deactivate';
    }

}
