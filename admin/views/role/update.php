<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Role */

$this->title = 'Update role';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="role-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
