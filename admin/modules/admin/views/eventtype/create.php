<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Itemtype */

$this->title = 'Create event type';
$this->params['breadcrumbs'][] = ['label' => 'Eventtypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventtype-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
