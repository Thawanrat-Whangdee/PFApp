<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Carry $model */

$this->title = 'Update Carry: ' . $model->_id;
$this->params['breadcrumbs'][] = ['label' => 'Carries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->_id, 'url' => ['view', '_id' => (string) $model->_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carry-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
