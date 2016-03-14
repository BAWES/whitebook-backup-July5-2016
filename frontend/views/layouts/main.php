<?php
//use yii;
use backend\models\Vendor;
use yii\helpers\Html;

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Url;
use backend\models\Socialinfo;
use backend\models\Siteinfo;
/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
$this->beginPage()
?>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta type="viewport" content="width=device-width , initial-scale1.0">
		<meta content="telephone=no" name="format-detection">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
		<link rel="shortcut icon" href="<?php echo Url::toRoute('/frontend/web/images/favicon.png',true);?>" type="image/x-icon"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 	</head>
	<body class="has-js">
		<!-- <div class="fullpage" style="width:100%;height:100%"></div> -->
		<div id="loader2" style="display:none;text-align: center; position: fixed; width: 100%;height: 100%;z-index: 1;opacity: 0.6;background: #fff;"><img style="position:absolute;top:50%;" src="<?php echo Url::toRoute('/images/ajax-loader.gif',true); ?>" title="Loader"></div>
		<!-- Header Section Start -->
		<?php
  $this->beginBody();
		$this->beginContent('@app/views/layouts/header.php');   ?>
		<?php  		 $this->endContent(); ?>
		<!-- Header Section End -->

		<!--Content Start-->
		<?= $content ?>
		<!--Content End-->

		<!-- Footer Section Start -->
		<?php $this->beginContent('@app/views/layouts/footer.php',['socialinfo'=>Socialinfo::socialinformation(), 'siteinfo'=>Siteinfo::siteinformation()]); ?>
		<?php $this->endContent(); ?>
  <?php $this->endBody() ?>
		<!-- Footer Section End -->
	</body>
</html>
<?php $this->endPage() ?>
