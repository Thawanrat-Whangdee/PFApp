<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Limit */

// $this->title = $model->_id;
// $this->params['breadcrumbs'][] = ['label' => 'Limits', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="limit-view">

    <?= Html::a('back', ['limit/index'], ['class' => 'profile-link']) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // '_id',
            'amount',
            // 'user_id',
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
