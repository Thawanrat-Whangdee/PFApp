<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Savings */

$this->title = 'Update Savings';
// $this->params['breadcrumbs'][] = ['label' => 'Savings', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->_id, 'url' => ['view', '_id' => (string) $model->_id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="savings-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
