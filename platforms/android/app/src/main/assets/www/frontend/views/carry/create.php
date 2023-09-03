<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Carry $model */

$this->title = 'Create Carry';
$this->params['breadcrumbs'][] = ['label' => 'Carries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
