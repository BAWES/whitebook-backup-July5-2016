<?php
namespace admin\models;
use Yii;

/**
 * This is the model class for table "whitebook_address_question".
 *
 * @property integer $ques_id
 * @property integer $address_type_id
 * @property string $question
 * @property string $status
 * @property integer $created_by
 * @property integer $modified_by
 * @property string $created_date
 * @property string $modified_date
 * @property string $trash
 */
class AddressQuestion extends \common\models\AddressQuestion
{

    public static function  loadAddressquestion($addresstypeid)
    {
        $question = AddressQuestion::find()
        ->select(['ques_id','address_type_id','question'])
        ->where(['address_type_id'=>$addresstypeid])->all();
       return $question;
    }

    public static function  loadquestion($addresstypeid)
    {
        $question = AddressQuestion::find()
        ->select(['question'])
        ->where(['address_type_id'=>$addresstypeid])->all();
        foreach ($question as $q)
        {
            $ques[]=$q['question'];
        }
        $ques=implode ('<br>',$ques);
        return($ques);
    }
    
    public static function statusImageurl($img_status)
    {
        if($img_status == 'Active')
        return \Yii::$app->urlManagerBackEnd->createAbsoluteUrl('themes/default/img/active.png');
        return \Yii::$app->urlManagerBackEnd->createAbsoluteUrl('themes/default/img/inactive.png');
    }
}