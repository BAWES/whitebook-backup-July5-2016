<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AddressQuestion */

$this->title = 'Update Address Question: ';
$this->params['breadcrumbs'][] = ['label' => 'Address Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="address-question-update">

    <?= $this->render('_form', [
        'model' => $model,'addresstype'=>$addresstype,'addressquestion'=>$addressquestion,
    ]) ?>

</div>
