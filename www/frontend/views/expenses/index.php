<?php

use app\models\Expenses;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExpensesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Expenses';
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$total = 0;
?>
<style>
    .bg-register-image {
        background: url("https://www.sketchappsources.com/resources/source-image/investing-finance-icons-fullratio.png");
        background-position: center;
        background-size: cover;
    }
    .bg-register-color {
        background-image: url('https://media.istockphoto.com/id/657808882/photo/gradient-blue-light-background.jpg?s=612x612&w=0&k=20&c=ZpJp7r_3f3BFcHgoAw2GG4QEr_BjOAlXZBmvjLYCEFM=');
        background-size: cover;
    }
    .block {
        border-radius: 10rem;
        padding: 1.5rem 1rem;
    }
</style>

<div class="expenses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // '_id',
            // 'expense_type',
            [
                'attribute' => 'expense_type',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function ($model) {
                    return implode(",", (array)$model->expense_type);
                },
            ],
            'amount',
            // 'create_date',
            // 'update_date',
            //'create_by',
            //'update_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \app\models\Expenses $model, $key, $index, $column) {
                    return Url::toRoute([$action, '_id' => (string) $model->_id]);
                 }
            ],
        ],
    ]); ?>


</div>

