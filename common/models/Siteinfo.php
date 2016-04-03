<?php
namespace backend\models;
use Yii;


class Siteinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%siteinfo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_name', 'app_desc', 'meta_keyword', 'meta_desc', 'email_id', 'site_location', 'site_copyright','currency_symbol'], 'required'],
            [['app_name', 'app_desc', 'site_location','phone_number','meta_keyword', 'meta_desc', 'email_id', 'site_copyright','commision'],'required', 'on' => 'update'],
            [['app_desc', 'meta_desc'], 'string'],            
            [['commision'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            [['site_logo', 'site_favicon'],'file','extensions' => ['png', 'jpg', 'jpeg']],
            [['app_name'], 'string', 'max' => 100],
            [['meta_keyword'], 'string', 'max' => 250],
            [['email_id'], 'string', 'max' => 50],
            [['site_copyright', 'site_favicon'], 'string', 'max' => 200],            
            /* Validation Rules */
            [['email_id'],'email'],
            ['phone_number','match', 'pattern' => '/^[0-9+ -]+$/','message' => 'Phone number accept only numbers and +,-']
        ];
    }
    
    public function scenarios()
    {
		$scenarios = parent::scenarios();        
        $scenarios['update'] = ['app_name', 'app_desc', 'site_location','phone_number','meta_keyword', 'meta_desc', 'email_id', 'site_copyright','commision','currency_symbol'];//Scenario Values Only Accepted
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_name' => 'App Name',
            'app_desc' => 'App Description',
            'meta_keyword' => 'Meta Keyword',
            'meta_desc' => 'Meta Description',
            'email_id' => 'Email ID',
            'phone_number' => 'Phone Number',            
            'site_location' => 'Site Location',            
            'site_copyright' => 'Site Copyright',
            'site_logo' => 'Site Logo',            
            'site_favicon' => 'Site Favicon',                      
            'facebook_key' => 'Facebook Key',        
            'commision' => 'Commision percentage',
            'currency_symbol'=>'Currency symbol',      
           
        ];
    }
    public static function logoUrl()
    {
		$model = Siteinfo::find()->all();        
		foreach($model as $key=>$val)
		{
			 $logo = $val['site_logo'];
			 echo Yii::getAlias('@web/uploads/app_img').'/'.$logo;
		}
	}
	
	public static function faviconUrl()
    {
		$model = Siteinfo::find()->all();
		foreach($model as $key=>$val)
		{
			 $logo = $val['site_favicon'];
			 echo Yii::getAlias('@web/uploads/app_img').'/'.$logo;
		}
	}

    // Datas using frontend
    public static function siteinformation()
    {
        $model = Siteinfo::find()->all();
        foreach($model as $key=>$val)
        {
             return $val;
        }        
    }     
	
}