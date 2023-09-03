<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Savings */

$this->title = $model->_id;
// $this->params['breadcrumbs'][] = ['label' => 'Savings', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="savings-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('back', ['savings/index'], ['class' => 'profile-link']) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            '_id',
            'amount',
            'start_date',
            'end_date',
            // 'user_id',
        ],
    ]) ?>
    <p>
        <?= Html::a('Update', ['update', '_id' => (string) $model->_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', '_id' => (string) $model->_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
