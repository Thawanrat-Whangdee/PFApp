<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Incomes */

$this->title = $model->_id;
// $this->params['breadcrumbs'][] = ['label' => 'Incomes', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="incomes-view">
    <?= Html::a('back', ['incomes/index'], ['class' => 'profile-link']) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // '_id',
            // 'income_type',
            [
                'attribute' => 'income_type',
                'format' => 'raw',
                // 'contentOptions' => ['class' => 'text-center'],
                'value' => function ($model) {
                    return implode(",", (array)$model->income_type);
                },
            ],
            'amount',
            'create_date',
            // 'update_date',
            // 'create_by',
            // 'update_by',
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
