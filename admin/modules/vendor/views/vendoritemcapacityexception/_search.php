<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VendoritemcapacityexceptionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendoritemcapacityexception-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'exception_id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'exception_date') ?>

    <?= $form->field($model, 'exception_capacity') ?>

    <?= $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>