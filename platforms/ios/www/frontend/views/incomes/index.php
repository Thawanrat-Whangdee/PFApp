<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $searchModel app\models\IncomesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Incomes';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="incomes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            // '_id',
            // 'income_type',
            [
                'attribute' => 'income_type',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function ($model) {
                    return implode(",", (array)$model->income_type);
                },
            ],
            'amount',
            // 'create_date',
            // 'update_date',
            //'create_by',
            //'update_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \app\models\Incomes $model, $key, $index, $column) {
                    return Url::toRoute([$action, '_id' => (string) $model->_id]);
                 }
            ],
        ],
    ]); ?>


</div>
