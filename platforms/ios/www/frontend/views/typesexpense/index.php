<?php

use app\models\Typesexpense;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TypesexpenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>


<body style="background-color: #41DBC6;background-size: cover;background-position: center;">
    <div class="typesexpense-index">

        <div class="card" style="border-radius: 30px;">
            <div class="container">
                <table>
                    <tr>
                        <th>
                            <?= Html::a('<i class="fa fa-chevron-left" style="margin-top:30px;"></i>', ['expenses/create']); ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <h4 class="card-title" style="margin-top: 20px; margin-right: 10px; margin-left:15px;"><b>Expenses Type</b></h4>
                        </th>
                        <th></th>
                        <th>
                            <?= Html::a('<i class="fa-solid fa-plus"></i>', ['create'], ['class' => 'btn btn-success btn-block rounded-pill', 'style' => 'color: white;']) ?>
                        </th>
                    </tr>
                </table>

                <?php
                $dataProvider = new ActiveDataProvider([
                    'query' => Typesexpense::find()
                        ->andWhere(['OR', ['user_id' => ""], ['user_id' => (string) Yii::$app->user->identity->id]])
                ]);

                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'attribute' => 'type_name',
                            'format' => 'raw',
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, \app\models\Typesexpense $model, $key, $index, $column) {
                                return Url::toRoute([$action, '_id' => (string) $model->_id]);
                            },
                            'visibleButtons' => [
                                'view' => false,
                            ],
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<i class="fas fa-pencil-alt fa-xs"></i>', $url, [
                                        'class' => 'btn btn-warning rounded-pill shadow-lg',
                                        'style' => 'color:white;',
                                        'title' => 'Edit',
                                    ]);
                                },
                                'delete' => function ($url, $model, $key) {
                                    // Check if there are incomes with the same income_type as the Typeincome
                                    $hasExpenses = \app\models\Expenses::find()->where(['expense_type' => $model->type_name])->exists();

                                    if ($hasExpenses) {
                                        return Html::a('<i class="fas fa-trash-alt"></i>', '#', [
                                            'class' => 'btn btn-danger rounded-pill shadow-lg',
                                            'title' => 'Delete',
                                            'data-confirm' => 'This type has been used to add expense. It cannot be deleted.',
                                            'data-method' => 'post',
                                            'disabled' => true, // Disable the link
                                        ]);
                                    } else {
                                        $deleteUrl = Url::toRoute(['delete', '_id' => (string) $model->_id]);
                                        return Html::a('<i class="fas fa-trash-alt"></i>', $deleteUrl, [
                                            'class' => 'btn btn-danger rounded-pill shadow-lg',
                                            'title' => 'Delete',
                                            'data-confirm' => 'Are you sure you want to delete this type?',
                                            'data-method' => 'post',
                                        ]);
                                    }
                                },
                            ],
                        ],
                    ],
                    'summary' => '',
                    'options' => ['class' => 'table table-borderless'],
                    'tableOptions' => ['class' => 'table table-borderless'],
                ]);
                ?>
            </div>
        </div>
    </div>
</body>