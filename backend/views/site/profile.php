<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
<div class="loadingmessage" style="display: none;">
<p>
<?= Html::img(Yii::getAlias('@web/themes/default/img/loading.gif'), ['class'=>'','width'=>'64px','height'=>'64px','id'=>'loading','alt'=>'loading']);?>
</p>
</div>

<!-- Begin Twitter Tabs-->
<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active">
      <a href="#1" data-toggle="tab">Basic Info </a>
    </li>
    <li>
      <a href="#2" data-toggle="tab" class="onevalid1">Main Info</a>
    </li>
    <li>
      <a href="#3" data-toggle="tab" class="twovalid2">Additional Info</a>
    </li>
    <li>
      <a href="#4" data-toggle="tab" class="twovalid2">Social Info</a>
    </li>
  </ul>
  <div class="tab-content">
<!-- Begin First Tab -->
   <div class="tab-pane" id="1" >
   <?php /*if(!$model->isNewRecord)
   {
   		$time = explode(':',$model->vendor_working_hours);
   		 $model->vendor_working_hours = $time[0];
   		 $model->vendor_working_min = $time[1];
   		 $time1 = explode(':',$model->vendor_working_hours_to);
   		 $model->vendor_working_hours_to = $time1[0];
   		 $model->vendor_working_min_to = $time1[1];
   }*/ ?>
    <div class="form-group vendor_logo">
	<?= $form->field($model, 'vendor_logo_path',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->label('Vendor logo'.Html::tag('span', '*',['class'=>'required']))->fileInput()->hint('Logo Size 150 * 250') ?>
	<!-- Venodr logo begin -->
	<?php if(isset($model->vendor_logo_path)) {
		echo Html::img(Yii::getAlias('@vendor_logo/').$model->vendor_logo_path, ['class'=>'','width'=>'125px','height'=>'125px','alt'=>'Logo']);
		} ?>
	<!-- Venodr logo end -->
	</div>

   <div class="form-group">
	<?= $form->field($model, 'vendor_name',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100]) ?>
	</div>

	<div class="form-group">
	<?= $form->field($model, 'vendor_contact_name',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100,]) ?>
	</div>

	<div class="form-group">
	<?= $form->field($model, 'vendor_contact_email',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100,'readonly'=>true,]) ?>
	</div>

	<div class="form-group" style="border: 1px solid #ccc;  padding: 5px;  font-size: 14px;">
		<label class="control-label" for="vendor-vendor_contact_number">Contact Phone Number</label>
	<?php
	$i =1;
	$count_vendor =  count($vendor_contact_number);
	foreach($vendor_contact_number as $contact_numbers)
	{ ?>
	<?= $form->field($model, 'vendor_contact_number[]',[  'template' => "<div class='controls".$i."'>{input}<input type='button' name='remove' id='remove' value='Remove' onClick='removePhone(".$i.")' style='margin:5px;' /></div> {hint} {error}"
	])->textInput(['multiple' => 'multiple','autocomplete' => 'off','value'=>$contact_numbers]) ?>

	<?php $i++; } ?>
	<input type="button" name="add_item" id="addnumber" value="Add phone numbers" onClick="addPhone('current');" style="margin:5px;" />

	</div>

	<div class="form-group" style="width: 150px; float: left;">
	<?= $form->field($model, 'vendor_working_hours',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->dropDownList(['01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12'])->label(); ?>
	</div>

	<div class="form-group" style="width: 150px; float: left;  margin-left: 25px;">
	<?= $form->field($model, 'vendor_working_min',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->dropDownList(['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'])->label(); ?>
	</div>

	<div class="form-group" style="width: 150px; float: left;">
	<?= $form->field($model, 'vendor_working_hours_to',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->dropDownList(['01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12'])->label(); ?>
	</div>

	<div class="form-group" style="width: 150px; float: left;  margin-left: 25px;">
	<?= $form->field($model, 'vendor_working_min_to',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->dropDownList(['00'=>'00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31','32'=>'32','33'=>'33','34'=>'34','35'=>'35','36'=>'36','37'=>'37','38'=>'38','39'=>'39','40'=>'40','41'=>'41','42'=>'42','43'=>'43','44'=>'44','45'=>'45','46'=>'46','47'=>'47','48'=>'48','49'=>'49','50'=>'50','51'=>'51','52'=>'52','53'=>'53','54'=>'54','55'=>'55','56'=>'56','57'=>'57','58'=>'58','59'=>'59'])->label(); ?>
	</div>

	<div class="form-group" style="clear:both;">
	<?= $form->field($model, 'vendor_contact_address',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textArea() ?>
	</div>
	<div class="form-group" style="height: 10px;">
	<input type="button" name="btnPrevious" class="btnNext btn btn-info" value="Next">
	</div>

	</div>

	<!--End First Tab -->

	<div class="tab-pane" id="2">

	<div class="form-group">
    <p style="font-size:14px;"> Category</p><p style="font-weight:bold; border:1px solid #ccc;padding:5px"> <?php echo implode(' , ',$vendor_categories); ?> </p>
	</div>
	<input type="hidden" id="test1" value="0" name="tests">

	<div class="form-group">
	<?= $form->field($model, 'vendor_return_policy',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textArea(['id'=>'text-editor']) ?>
	</div>

	<div class="form-group">
	<?= $form->field($model, 'vendor_fax',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput() ?>
	</div>

	<div class="form-group">
	<?= $form->field($model, 'short_description',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textArea() ?>
	</div>

	<div class="form-group">
	<?= $form->field($model, 'vendor_bank_name',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput() ?>
	</div>

	<div class="form-group">
	<?= $form->field($model, 'vendor_bank_branch',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput() ?>
	</div>

	<div class="form-group">
	<?= $form->field($model, 'vendor_account_no',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput() ?>
	</div>

	<input type="button" name="btnPrevious" class="btnPrevious btn btn-info" value="Prev">
	<input type="button" name="btnNext" class="btnNext btn btn-info" value="Next">
</div>
		<!--End Third Tab -->

<div class="tab-pane" id="3">

	<div class="form-group">
	<?= $form->field($model, 'vendor_public_phone',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100]) ?>
	</div>

	<div class="form-group">
	<?= $form->field($model, 'vendor_public_email',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100]) ?>
	</div>

	<div class="form-group">
	<?= $form->field($model, 'vendor_emergency_contact_email',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100]) ?>
	</div>

	<div class="form-group">
	<?= $form->field($model, 'vendor_website',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100]) ?>
	</div>

	<input type="button" name="btnPrevious" class="btnPrevious btn btn-info" value="Prev">
	<input type="button" name="btnNext" class="btnNext btn btn-info" value="Next">
</div>

<div class="tab-pane" id="4">
		<div class="form-group">
	<?= $form->field($model, 'vendor_facebook',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100]) ?>
	</div>

		<div class="form-group">
	<?= $form->field($model, 'vendor_twitter',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100]) ?>
	</div>

		<div class="form-group">
	<?= $form->field($model, 'vendor_instagram',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100]) ?>
	</div>

		<div class="form-group">
	<?= $form->field($model, 'vendor_googleplus',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100]) ?>
	</div>

		<div class="form-group">
	<?= $form->field($model, 'vendor_skype',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}"
	])->textInput(['maxlength' => 100]) ?>
	</div>

<div class="form-group">
    	<input type="button" name="btnPrevious" class="btnPrevious btn btn-info" value="Prev">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','style'=>'float:right;']) ?>
           </div>
</div></div>
</div>
    <?php ActiveForm::end(); ?>

</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= Url::to("@web/themes/default/plugins/ckeditor/ckeditor.js") ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">
$(function()
{
	CKEDITOR.replace('text-editor');
});
    $(function (){
 	/* Begin when loading page first tab opened */
 	$('.nav-tabs li:first').addClass("active");
 	$(".tab-content div:first").addClass("active");
 	});

function removePhone(phone) {
	$(".controls"+phone).remove();
}

	/* Begin Tabs NEXT & PREV buttons */
	$('.btnNext').click(function(){
	  $('.nav-tabs > .active').next('li').find('a').trigger('click');
	});

	  $('.btnPrevious').click(function(){
	  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
	});

	/* End Tabs NEXT & PREV buttons */
</script>

<script>
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  var c1 = true;
$( ".onevalid1" ).click(function() {

	if($('#test').val()==1)
	{
		return false;
	}
	if($('#test1').val()==1)
	{
		return false;
	}

  if($("#vendor-vendor_name").val()=='')
	{
			$(".field-vendor-vendor_name").addClass('has-error');
			$(".field-vendor-vendor_name").find('.help-block').html('Vendor name cannot be blank.');
			c1=false;
  	}
  	if($("#vendor-vendor_contact_email").val()=='')
	{
			$(".field-vendor-vendor_contact_email").addClass('has-error');
			$(".field-vendor-vendor_contact_email").find('.help-block').html('Email cannot be blank.');
			c1=false;
  	}
    // check only if its new record

  if($("#vendor-vendor_password").val()=='')
	{
			$(".field-vendor-vendor_password").addClass('has-error');
			$(".field-vendor-vendor_password").find('.help-block').html('Password cannot be blank');
			c1=false;
  }
  if($("#vendor-vendor_contact_name").val()=='')
	{
			$(".field-vendor-vendor_contact_name").addClass('has-error');
			$(".field-vendor-vendor_contact_name").find('.help-block').html('Contact name  cannot be blank.');
			c1=false;
  }
    if($("#vendor-vendor_contact_number").val()=='')
	{
			$(".field-vendor-vendor_contact_number").addClass('has-error');
			$(".field-vendor-vendor_contact_number").find('.help-block').html('Contact number cannot be blank.');
			c1=false;
  }
    if($("#vendor-vendor_contact_address").val()=='')
	{
			$(".field-vendor-vendor_contact_address").addClass('has-error');
			$(".field-vendor-vendor_contact_address").find('.help-block').html('Contact address cannot be blank.');
			c1=false;
  }
  else
  	{
  				$(".field-vendor-vendor_contact_address").removeClass('has-error');
				$(".field-vendor-vendor_contact_address").addClass('has-success');
				c1=true;
  	}
	  if(c1==false)
	  {
		  c1='';
		  return false;
		}

	var item_len = $("#vendor-vendor_name").val().length;
     if($("#vendor-vendor_name").val()=='')
	 {
	 	$(".field-vendor-vendor_name").addClass('has-error');
			$(".field-vendor-vendor_name").find('.help-block').html('Item name cannot be blank.');
			c1=false;
	 }
	 else if(item_len < 3){

	 			$(".field-vendor-vendor_name").addClass('has-error');
	 			$(".field-vendor-vendor_name").find('.help-block').html('Item name minimum 4 letters.');
				c1=false;
	 }
return c1;
});


$( ".twovalid2" ).click(function() {

  if($("#vendor-vendor_name").val()=='')
	{
			$(".field-vendor-vendor_name").addClass('has-error');
			$(".field-vendor-vendor_name").find('.help-block').html('Vendor name cannot be blank.');
			return false;
  }
  if($("#vendor-vendor_contact_email").val()=='')
	{
			$(".field-vendor-vendor_contact_email").addClass('has-error');
			$(".field-vendor-vendor_contact_email").find('.help-block').html('Email cannot be blank.');
			return false;
  }

    if($("#vendor-vendor_contact_name").val()=='')
	{
			$(".field-vendor-vendor_contact_name").addClass('has-error');
			$(".field-vendor-vendor_contact_name").find('.help-block').html('Contact name  cannot be blank.');
			return false;
  }
    if($("#vendor-vendor_contact_number").val()=='')
	{
			$(".field-vendor-vendor_contact_number").addClass('has-error');
			$(".field-vendor-vendor_contact_number").find('.help-block').html('Contact number cannot be blank.');
			return false;
  }
    if($("#vendor-vendor_contact_address").val()=='')
	{
			$(".field-vendor-vendor_contact_address").addClass('has-error');
			$(".field-vendor-vendor_contact_address").find('.help-block').html('Contact address cannot be blank.');
			return false;
  }

 else
  {return true;}
});

var j= <?= $count_vendor+1; ?>;
function addPhone(current)
{
$('#addnumber').before('<div class="controls'+j+'"><input type="text" id="vendor-vendor_contact_number'+j+'" class="form-control" name="Vendor[vendor_contact_number][]" multiple = "multiple" maxlength="15" Placeholder="Phone Number" style="margin:5px 0px;"><input type="button" name="remove" id="remove" value="Remove" onClick="removePhone('+j+')" style="margin:5px;" /></div>');

   j++;

  $("#vendor-vendor_contact_number2").keypress(function (e) {
     if (  e.which  != 43   && e.which  != 45 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57 )) {
          $(".field-vendor-vendor_contact_number").find('.help-block').html('Contact number digits only+.').animate({ color: "#a94442" }).show().fadeOut(2000);
               return false;
    }
   });
  $("#vendor-vendor_contact_number3").keypress(function (e) {
     if ( e.which  != 43   && e.which  != 45  && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          $(".field-vendor-vendor_contact_number").find('.help-block').html('Contact number digits only.').animate({ color: "#a94442" }).show().fadeOut(2000);
               return false;
    }
   });
  $("#vendor-vendor_contact_number4").keypress(function (e) {
     if ( e.which  != 43   && e.which  != 45 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          $(".field-vendor-vendor_contact_number").find('.help-block').html('Contact number digits only.').animate({ color: "#a94442" }).show().fadeOut(2000);
               return false;
    }
   });


  $("#vendor-vendor_contact_number5").keypress(function (e) {
     if ( e.which  != 43   && e.which  != 45 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          $(".field-vendor-vendor_contact_number").find('.help-block').html('Contact number digits only.').animate({ color: "#a94442" }).show().fadeOut(2000);
               return false;
    }
   });
}
</script>
