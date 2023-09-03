<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LimitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Limits';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="limit-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            // '_id',
            'amount',
            // 'user_id',
            'create_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \app\models\Limit $model, $key, $index, $column) {
                    return Url::toRoute([$action, '_id' => (string) $model->_id]);
                 }
            ],
            // 'update_date',
            //'create_by',
            //'update_by',
        ],
    ]); ?>


</div>
