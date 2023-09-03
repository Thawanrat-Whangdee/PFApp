<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Incomes */

$this->title = 'Add Incomes';
// $this->params['breadcrumbs'][] = ['label' => 'Incomes', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="incomes-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
