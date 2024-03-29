<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DeliverytimeslotSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deliverytimeslot-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'timeslot_id') ?>

    <?= $form->field($model, 'vendor_id') ?>

    <?= $form->field($model, 'timeslot_day') ?>

    <?= $form->field($model, 'timeslot_start_time') ?>

    <?= $form->field($model, 'timeslot_end_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
