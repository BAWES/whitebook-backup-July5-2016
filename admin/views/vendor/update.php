<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vendor */

$this->title = 'Update vendor: ' . ' ' . $model->vendor_name;
$this->params['breadcrumbs'][] = ['label' => 'Manage vendor', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vendor-update">

   <?= $this->render('_form', [
        'model' => $model,'package' => $package,'vendor_contact_number'=>$vendor_contact_number,'present_package'=>$present_package,
    ]) ?>

</div>
