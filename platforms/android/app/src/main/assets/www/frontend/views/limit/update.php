<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Limit */

$this->title = 'Update Limit';
// $this->params['breadcrumbs'][] = ['label' => 'Limits', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->_id, 'url' => ['view', '_id' => (string) $model->_id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="limit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
