<?php
namespace frontend\models;

use Yii;

class Vendor extends \common\models\Vendor
{

    // Pass vendor contact address  
    public static function vendorcontactaddress($id){
    $vendordetail= Vendor::find()
        ->select(['vendor_contact_address','vendor_contact_number'])
        ->where(['vendor_id'=>$id])
        ->one();
        return $vendordetail;
    }

    // Pass vendor social details  
    public static function sociallist($id){
        $socialdetail= Vendor::find()
        ->select(['vendor_facebook','vendor_twitter','vendor_instagram','vendor_googleplus','vendor_contact_email'])
        ->where(['vendor_id'=>$id])
        ->one();
        return $socialdetail;
    }
    
       /* load vendor details */
    public static function loadvendornames()
    {
            $vendorname= Vendor::find()
            ->where(['!=', 'vendor_status', 'Deactive'])
            ->andwhere(['!=', 'trash', 'Deleted'])
            ->asArray()
            ->all();
            return $vendorname;
    }

    /* load vendor details for front end */
    public static function loadvalidvendors()
    {	
    	$vendor = Vendor::find()
        ->select('{{%vendor}}.vendor_id')
        ->leftJoin('{{%vendor_item}}', '{{%vendor_item}}.vendor_id = {{%vendor}}.vendor_id')
        ->where(['{{%vendor}}.vendor_status' => 'Active','{{%vendor}}.trash' => 'Default','{{%vendor_item}}.trash' => 'Default','{{%vendor_item}}.item_status' => 'Active','{{%vendor_item}}.item_for_sale' => 'Yes','{{%vendor_item}}.item_approved' => 'Yes'])
        ->distinct()
        ->all();

        /* STEP 2 CHECK PACKAGE */
        foreach ($vendor as $key => $value) {
            $package[] = Vendor::packageCheck($value['vendor_id'],$check_vendor="Notempty");
        }

        return $active_vendors = implode('","', array_filter($package));
    }


    public static function loadvendor_item($item)
    {
        $k=array();
		foreach ($item as $data){
		$k[]=$data;
		}
		$id = implode("','", $k);
		$val = "'".$id."'";
        /* STEP 1 GET ACTIVE VENDORS*/
        $vendor = Vendor::find()
        ->select('{{%vendor}}.vendor_id,{{%vendor}}.vendor_name,{{%vendor}}.slug')
        ->leftJoin('{{%vendor_item}}', '{{%vendor_item}}.vendor_id = {{%vendor}}.vendor_id')
        ->where(['{{%vendor}}.vendor_status' => 'Active','{{%vendor}}.trash' => 'Default','{{%vendor_item}}.trash' => 'Default','{{%vendor_item}}.item_status' => 'Active','{{%vendor_item}}.item_for_sale' => 'Yes','{{%vendor_item}}.item_approved' => 'Yes'])
        ->all();
    

    foreach ($vendor as $key => $value) {
        $package[] = Vendor::packageCheck($value['vendor_id'],$check_vendor="Notempty");
    }
        $active_vendors = implode('","', array_filter($package));
        $query = Vendor::find()
        ->select(['vendor_id','slug','vendor_name'])
        ->where('vendor_id IN ("'.$active_vendors.'")')->asArray()->all();
	return ($query);
    }

    public static function loadvalidvendorids($cat_id=false)
    {
        $expression = new \yii\db\Expression('NOW()');
		$now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW();

		$blocked_vendors = \common\models\Blockeddate::find()
                    ->select('GROUP_CONCAT(vendor_id) as vendor_id')
                    ->where(['DATE(block_date)' =>$now ])
                    ->asArray()
                    ->all();
            $condn = '';
            
        if($blocked_vendors[0]['vendor_id'] !='')
        {
            $condn = ",'"."not in"."',";
            $condn .= "'"."{{%vendor}}.vendor_id"."',";
            $condn .= $blocked_vendors['vendor_id'];
        }

        if($cat_id!='')
        {
            $condn .= '{{%vendor_item}}.category_id ='. $cat_id;
        }
            
		 $vendor = Vendor::find()
        ->select('{{%vendor}}.*')
        ->leftJoin('{{%vendor_item}}', '{{%vendor_item}}.vendor_id = {{%vendor}}.vendor_id')
        ->where(['{{%vendor}}.vendor_status' => 'Active',
            '{{%vendor}}.trash' => 'Default','{{%vendor_item}}.trash' => 'Default',
            '{{%vendor_item}}.item_status' => 'Active','{{%vendor_item}}.item_for_sale' => 'Yes',
            '{{%vendor_item}}.type_id' => '2'.$condn])
        ->distinct()
        ->asArray()
        ->all();
        $package = array();

        /* STEP 2 CHECK PACKAGE */
        foreach ($vendor as $key => $value) {
            $package[] = Vendor::packageCheck($value['vendor_id'],$check_vendor="Notempty");
        }
        if($package =='')
        {
            return '';
        }
        
        return $active_vendors = array_filter($package);
    }

    /* Load who vendor having category  */
    public static function Vendorcategories($slug){
        $vendor_category = Vendor::find()
            ->select(['category_id'])
            ->where(['slug'=>$slug])
            ->asArray()
            ->one();
            return $vendor_category;
        }

    public static function Vendorid_item($slug){
        $vendor_category = Vendor::find()
            ->select(['vendor_id'])
            ->where(['slug'=>$slug])
            ->asArray()
            ->one();
            return $vendor_category;
        }

    public static function get_directory_list() {
        $today = date('Y-m-d H:i:s');
        return $data=Vendor::find()
        ->select(['{{%vendor}}.vendor_id AS vid',
                    '{{%vendor}}.vendor_name AS vname',
                    '{{%vendor}}.slug AS slug'])
            ->leftJoin('{{%vendor_packages}}', '{{%vendor}}.vendor_id = {{%vendor_packages}}.vendor_id')
            ->where(['<=','{{%vendor_packages}}.package_start_date',$today])
            ->andWhere(['>=','{{%vendor_packages}}.package_end_date',$today])
			->andWhere(['{{%vendor}}.trash'=>'Default'])
			->andWhere(['{{%vendor}}.approve_status'=>'Yes'])
			->andWhere(['{{%vendor}}.vendor_status'=>'Active'])
			->orderby(['{{%vendor}}.vendor_name'=>SORT_ASC])
			->groupby(['{{%vendor}}.vendor_id'])
			->asArray()
			->all();
    }

   // Pass vendor slug to frontend
   public static function vendorslug($id){
        $vendorname= Vendor::find()
            ->select(['vendor_name','slug'])
            ->where(['vendor_id'=>$id])
            ->one();
            return $vendorname;
        }
}
