<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchCustomerAddress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-address-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'address_id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'address_type_id') ?>

    <?= $form->field($model, 'country_id') ?>

    <?= $form->field($model, 'city_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
