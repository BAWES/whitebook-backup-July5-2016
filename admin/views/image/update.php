<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Image */

$this->title = 'Update Image: ' . ' ' . $model->image_id;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->image_id, 'url' => ['view', 'id' => $model->image_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
