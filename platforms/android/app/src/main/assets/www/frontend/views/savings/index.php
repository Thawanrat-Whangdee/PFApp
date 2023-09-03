<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SavingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Savings';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="savings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            // '_id',
            'amount',
            'start_date',
            'end_date',
            // 'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \app\models\Savings $model, $key, $index, $column) {
                    return Url::toRoute([$action, '_id' => (string) $model->_id]);
                 }
            ],
        ],
    ]); ?>


</div>
