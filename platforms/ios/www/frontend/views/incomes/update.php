<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Incomes */

// $this->title = 'Update Incomes: ' . $model->_id;
// $this->params['breadcrumbs'][] = ['label' => 'Incomes', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->_id, 'url' => ['view', '_id' => (string) $model->_id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="incomes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
