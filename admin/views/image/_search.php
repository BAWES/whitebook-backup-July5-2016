<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ImageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'image_id') ?>

    <?= $form->field($model, 'image_user_id') ?>

    <?= $form->field($model, 'image_user_type') ?>

    <?= $form->field($model, 'image_path') ?>

    <?= $form->field($model, 'image_file_size') ?>
   
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
