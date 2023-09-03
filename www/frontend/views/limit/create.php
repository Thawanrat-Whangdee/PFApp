<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Limit */

$this->title = 'Add Limit';
// $this->params['breadcrumbs'][] = ['label' => 'Limits', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="limit-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
