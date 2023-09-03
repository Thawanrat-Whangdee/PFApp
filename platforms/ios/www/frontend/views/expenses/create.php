<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Expenses */

$this->title = 'Add Expenses';
// $this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenses-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
