<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VendoritemquestionguideSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendoritemquestionguide-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'guide_id') ?>

    <?= $form->field($model, 'question_id') ?>

    <?= $form->field($model, 'guide_image_id') ?>

    <?= $form->field($model, 'guide_caption') ?>

    <?= $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>