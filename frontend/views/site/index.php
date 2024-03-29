<?php

use common\models\Featuregroup;
use common\models\Featuregroupitem;
use common\models\Vendoritem;
use common\models\Vendor;
use common\models\Themes;
use common\models\Image;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Home | Whitebook';
use frontend\models\Website;
$model = new Website();
?>
<!-- content main start -->
<!-- banner section start -->
<?php if (count($banner) > 0) { ?>
<section id="banner_sections">
    <div class="banner_slider_content">
        <div class="carousel slide">
            <div class="carousel-inner owl-carousel" id="home-banner-slider">
            <?php $i = 1;
            foreach ($banner as $b) {
            ?>
            <div class="item">
                <?php if ($b['slide_type'] == 'video') { ?>
                <object width="100%" height="600" data="<?php echo $b['slide_video_url']; ?>" id="video_click"></object>
                <?php } else { ?>
                <?= Html::img(Yii::getAlias('@s3/slider_uploads/'. $b['slide_image']), ['alt' => 'My White Book']) ?>

                <?php } ?>
            </div>
            <?php $i++;
            } ?>

            </div>
        </div>
    </div>
</section>
<?php } ?>

<!-- banner section end -->

<!-- Content start -->
<section id="content_section">
<div class="container_plan">
<div class="container_common">

<!-- Events slider start -->
<?php

if (!Yii::$app->user->isGuest) {
require(__DIR__ . '/../product/events_slider.php');
} else {
?>
<span class="first_events">
    <?= Html::img('@web/images/my_book_desk.svg', ['alt' => 'My White Book']) ?>
</span>
<div class="creatfirst_events">
    <p data-example-id="active-anchor-btns" class="bs-example">
    <a href="javascript:" role="button" class="btn btn-default"  data-toggle="modal" data-target="#myModal" onclick="show_login_modal(-1);">
        <?= Yii::t('frontend', 'Create Your First Event'); ?>
    </a>
</p>
</div>
<?php } ?>

<!-- Events slider end -->

</div>
<div class="plan_sections">
<ul>
    <li>
        <div class="plan_list">
            <?= Html::img('@web/images/plan-home.jpg', ['alt' => 'Plan']) ?>
            <div class="inner_content_plan">
                <h1><?= Yii::t("frontend", "Plan") ?></h1>
                <p><?= Yii::t("frontend", "Plan is where you browse, get ideas, and plan your event") ?></p>
                <a href="<?= Url::toRoute('plan/plans'); ?>" role="button" class="btn btn-default"><?= Yii::t("frontend", "Discover") ?></a>
            </div>
        </div>
    </li>
    <li>
        <div class="plan_list">
            <?= Html::img('@web/images/shop-home.jpg', ['alt' => 'Shop']) ?>
            <div class="inner_content_plan">
                <h1><?= Yii::t("frontend", "Shop") ?></h1>
                <p><?= Yii::t("frontend", "Shop is where you purchase, customise, and schedule delivery of your products and services") ?></p>
                <a href="<?= Url::toRoute('site/shop'); ?>" role="button" class="btn btn-default"><?= Yii::t("frontend", "Discover") ?></a>
            </div>
        </div>
    </li>
    <li>
        <div class="plan_list">
            <?= Html::img('@web/images/experience-home.jpg', ['alt' => 'Experience']) ?>
            <div class="inner_content_plan">
                <h1><?= Yii::t("frontend", "Experience") ?></h1>
                <p><?= Yii::t("frontend", "Experience is a list of value added services provided by The White Book's team") ?></p>
                <a href="<?= Url::toRoute('site/experience'); ?>" role="button" class="btn btn-default"><?= Yii::t("frontend", "Discover") ?></a>
            </div>
        </div>
    </li>
</ul>
</div>

<!-- BEGIN FEATURE GROUP ITEM-->
<?php
$featured_produc = Featuregroup::find()->select(['group_id', 'group_name'])->where(['group_status' => 'Active', 'trash' => 'Default'])->asArray()->all();
$i = 1;
foreach ($featured_produc as $key => $value) {
 $feature_group_sql_result = Featuregroupitem::find()->select(['{{%vendor_item}}.*','{{%feature_group_item}}.vendor_id','{{%vendor}}.vendor_name'])
        ->joinWith('item')
        ->joinWith('vendor')
        ->join('inner join','{{%image}}','{{%image}}.item_id = {{%vendor_item}}.item_id')
        ->where(['{{%feature_group_item}}.group_id'=>$value["group_id"]])
        ->andWhere(['{{%vendor_item}}.type_id'=>2])
        ->andWhere(['{{%vendor_item}}.trash'=>"Default"])
        ->andWhere(['{{%vendor_item}}.trash'=>"Default"])
        ->andWhere(['{{%vendor_item}}.item_for_sale'=>"Yes"])
        ->andWhere(['{{%vendor_item}}.item_status'=>"Active"])
        ->andWhere(['{{%feature_group_item}}.group_item_status'=>"Active"])
        ->andWhere(['{{%feature_group_item}}.trash'=>"Default"])
        ->asArray()
        ->all();

$count_items = count($feature_group_sql_result);

if (!empty($feature_group_sql_result)) {
?>
    <div class="feature_product_title">
        <h2><?= $value['group_name']; ?></h2>
    </div>
<?php } ?>


<!-- BEGIN FEATURE PRODUCT DESKTOP  -->
<div class="feature_product_slider">
    <div class="most_popular_slider">
        <div class="slider_new_up">
            <div class="flexslider3">
                <div id="demo">
                    <div class="owl-carousel twb-slider" id="feature-group-slider" >
                        <?php
                        $i = 0;
                        foreach ($feature_group_sql_result as $product_val) {

                            if ($product_val['image_path'] = '23432434') {
                                $imglink = Yii::getAlias("@s3/vendor_item_images_210/") . $product_val['image_path'];
                            } else {
                                $imglink = Yii::getAlias("@web/images/no_image.jpg");
                            }
                            ?>
                            <div class="item">
                                <div class="fetu_product_list index_redirect" data-hr='<?= Url::toRoute(['/product/product', $product_val["slug"], true]); ?>'>
                                    <a href="<?= Url::toRoute(['/product/product','slug'=>$product_val["slug"], true]); ?>" title="" class='index_redirect' data-hr='<?= Url::toRoute(['/product/product', $product_val['slug'], true]); ?>'>
                                        <?= Html::img($imglink,['style'=>'width:208px; height:219px;']); ?>
                                        <div class="deals_listing_cont">
                                            <?php echo $product_val['vendor_name']; ?>
                                            <h3><?php echo $product_val['item_name']; ?></h3>
                                            <p><?php echo number_format($product_val['item_price_per_unit'], 2) . "KD"; ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php $i++;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<!-- END FEATURE PRODUCT DESKTOP  -->
<!-- BEGIN FEATURE PRODUCT RESPONSIVE -->

</div>
</section>

<?php
if(!Yii::$app->user->isGuest && count($featured_product) > 0){
foreach ($featured_product as $f) {
?>
<div class="modal fade" id="addevent<?php echo $f['item_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content  modal_member_login signup_poupu row">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="text-center">
            <span class="yellow_top"></span>
        </div>
        <h4 class="modal-title text-center" id="myModalLabel"><?php echo Yii::t('frontend', 'You are Adding'); ?></h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="product_popup_signup">
                    <div class="product_popup_prod">
                        <div class="desc_popup_cont">
                            <h4><?php echo $f['vendor']['vendor_name']; ?></h4>
                            <h3><?php echo $f['item_name']; ?></h3>
                            <div class="text-center"><span class="borderslid"></span></div>
                            <h5><?php echo number_format($f['item_price_per_unit'], 2) . "KWD"; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="product_popup_signup_box">
                    <div class="product_popup_signup_log">
                        <div class="add_event_form">

                        </div>
                        <div class="create_event_form">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php }
} ?>

<script type="text/javascript">
if(jQuery(window).width() < 991) {
    var lop = 0;
    jQuery('.plan_sections ul li').each(function (index, value) {
        var hrefli = jQuery(this).find('a').attr('href');
        jQuery(this).find('a').remove();
        jQuery(this).html('<a href="' + hrefli + '" >' + jQuery(this).html() + '<a>');
    });
}

/* VIDEO PLAY HOME START */
jQuery(document).ready(function () {
    jQuery('a.play_buttons').click(function () {
        jQuery('#video_click')[0].play();
        jQuery('#video_click').attr('controls', true);
        jQuery('a.play_buttons').hide();
    });
    jQuery('#video_click').bind('ended', function () {
        //$('#thisdiv').load(document.URL +  ' #thisdiv');
        jQuery('#video_click').load();
        jQuery('#video_click').attr('controls', false);
        jQuery('a.play_buttons').show();
    });
});

/* Hide BG FOR EVENT SLIDER IMPORTANT*/
jQuery('.directory_slider,.container_eventslider').load('events_slider', function(){
    jQuery(this).css('background','transparent');
    jQuery('.container_common').css('margin','0');
    jQuery('.event_slider_top').css({'padding':'5px 0 0 0','display':'inline-block','width':'100%','margin':'4px 0 0 0'});
});
</script>
<!-- Hide BG FOR EVENT SLIDER
 VIDEO PLAY HOME END -->

<!--END RESPONSIVE FOR HOME PAGE PLAN, SHOP, EXPERIENCE IMAGES WITH A TAG IMPORTANT-->
