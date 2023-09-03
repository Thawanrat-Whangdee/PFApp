<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pocket $model */

$this->title = 'Update Pocket: ' . $model->_id;
$this->params['breadcrumbs'][] = ['label' => 'Pockets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->_id, 'url' => ['view', '_id' => (string) $model->_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pocket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
