<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Savings */

$this->title = 'Add Savings';
// $this->params['breadcrumbs'][] = ['label' => 'Savings', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="savings-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
