<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Vendoritemquestionansweroption */

$this->title = $model->answer_id;
$this->params['breadcrumbs'][] = ['label' => 'Vendoritemquestionansweroptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendoritemquestionansweroption-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->answer_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->answer_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'answer_id',
            'question_id',
            'answer_background_image_id',
            'answer_text',
            'answer_background_color',
            'answer_price_added',
            'answer_archived',
            'created_by',
            'modified_by',
            'created_datetime',
            'modified_datetime',
            'trash',
        ],
    ]) ?>

</div>
