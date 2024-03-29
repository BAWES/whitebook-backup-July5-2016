<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
  <div class="col-md-8 col-sm-8 col-xs-8">    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="form-group">
	<?= $form->field($model, 'category_name',['template' => "{label}<div class='controls'>{input}</div>{hint}{error}"])->textInput(['maxlength' => 128])?>
</div> 
<div class="form-group">
	<?= $form->field($model, 'category_meta_title',['template' => "{label}<div class='controls'>{input}</div>{hint}{error}"])->textArea(['maxlength' => 250])?>
</div> 
    <div class="form-group">
	<?= $form->field($model, 'category_meta_keywords',['template' => "{label}<div class='controls'>{input}</div>{hint}{error}"])->textArea(['maxlength' => 250])?>
</div> 
    <div class="form-group">
	<?= $form->field($model, 'category_meta_description',['template' => "{label}<div class='controls'>{input}</div>{hint}{error}"])->textArea(['maxlength' => 250])?>
</div>

<div class="form-group">   
	<?= $form->field($model, 'category_allow_sale',[  'template' => "{label}<div class='controls'>{input}</div> {hint} {error}" 
	])->checkbox(['yes' => 'yes']) ?>
    </div>

    <div class="form-group">
		<?= $form->field($model, 'top_ad',['template' => "{label}<div class='controls'>{input}</div>{hint}{error}"])->textArea(['maxlength' => 250])?>
	</div>

    <div class="form-group">
		<?= $form->field($model, 'bottom_ad',['template' => "{label}<div class='controls'>{input}</div>{hint}{error}"])->textArea(['maxlength' => 250])?>
	</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Back', ['index', ], ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
	<?php if($model->isNewRecord){ ?>
	$('#category-category_allow_sale').prop('checked', true);
	<?php }
	else
	{ if($model->category_allow_sale=='yes'){?>
	$('#category-category_allow_sale').prop('checked', true);	
		<?php }	else { ?>
	$('#category-category_allow_sale').prop('checked', false);		
			<?php } ?>
	<?php } ?>
	
</script>



