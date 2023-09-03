<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Expenses */

$this->title = 'Update Expenses: ' . $model->_id;
// $this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->_id, 'url' => ['view', '_id' => (string) $model->_id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="expenses-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
