<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = 'Income';
?>
<!DOCTYPE html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Hind+Siliguri:wght@300&family=Nunito&family=Open+Sans&family=Sarabun:wght@200&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Balsamiq Sans', cursive;
        }

        .card {
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            width: 40%;
            margin: 2rem auto;
            height: 560;
            border-radius: 30px;
            margin-top: 10px;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .border {
            border-radius: 10rem;
        }

        .font {
            font-size: 14px;
        }

        .cartTotal {
            width: 150px;
            height: 560;
            border-radius: 10px;
            text-align: center;
        }
    </style>
    <script src="https://kit.fontawesome.com/c3c7a2a31a.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #f8f9fa; font-size: 14px;">
    <div class="card" style="width:100%">
        <div style="margin-top:10px; margin-bottom:10px;">
            <center>
                <table style="border:1; width:80%; text-align:center;">
                    <tr>
                        <th>
                                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/3237/3237857.png" width="38" height="38">', ['/site/overview']); ?>
                        </th>
                        <th>
                            <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/3143/3143636.png" width="32" height="32">', ['/site/calendar']); ?>
                        </th>
                        <th>
                            <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/2331/2331785.png" width="35" height="35">', ['/site/limit']); ?>
                        </th>
                        <th>
                            <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/4301/4301717.png" width="35" height="35">', ['/site/line']); ?>
                        </th>
                    </tr>
                    <tr>
                        <td>Overview</td>
                        <td>Calendar</td>
                        <td>Limits</td>
                        <td>Analyze</td>
                    </tr>
                </table>
            </center>
        </div>
    </div>
    <center>
        <div style="margin-top: 15px;">
            <?= Html::a('Income', ['/site/income'], ['class' => 'btn btn-info border font']); ?>
            <?= Html::a('Expense', ['/site/expense'], ['class' => 'btn btn-light border font']); ?>
        </div>
    <br>
    <div class="card" style="width: 100%; ">
        <div class="container">
            <div style="margin-right: 300px; margin-top: 10px;">
                <?= Html::a('<i class="fa fa-chevron-left"></i>', ['/site/overview']); ?>
            </div>
            <h4 class="card-title" style="text-align:center;"><b>Income List</b></h4>
            <p>
                    <?= date('F j, Y') ?>
            </p>
            <?php
            $today = date('Y-m-d');
            $userId = (string) Yii::$app->user->identity->id;
            
            $incomesQuery = \app\models\Incomes::find()
                ->where(['create_date' => $today])
                ->andWhere(['create_by' => $userId]);

            echo GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                            'query' => $incomesQuery,
                            'sort' => ['defaultOrder' => ['create_date' => SORT_DESC]],
                ]),
                'showHeader' => false,
                'columns' => [
                    [
                        'attribute' => 'income_type',
                        'format' => 'raw',
                        'contentOptions' => ['class' => ''],
                        'value' => function ($model) {
                            return implode(",", (array)$model->income_type);
                        },
                    ],
                    [
                        'attribute' => 'amount',
                        'format' => 'raw',
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, \app\models\Incomes $model, $key, $index, $column) {
                            if ($action === 'update') {
                                    return Url::toRoute(['site/update-income', '_id' => (string) $model->_id]);
                                }
                            return Url::toRoute([$action, '_id' => (string) $model->_id]);
                         },
                         'visibleButtons' => [
                            'view' => false,
                            // 'update' => false,
                            // 'delete' => false,
                         ],
                         'contentOptions' => ['class' => 'text-right'],
                         'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="fas fa-pencil-alt fa-xs"></i>', $url, [
                                    'class' => 'btn btn-primary rounded-pill shadow-lg',
                                    'title' => 'Edit',
                                ]);
                            },
                            'delete' => function ($url, $model, $key) {
                                $deleteUrl = Url::toRoute(['site/delete-income', '_id' => (string) $model->_id]);
                                return Html::a('<i class="fas fa-trash-alt"></i>', $deleteUrl, [
                                    'class' => 'btn btn-danger rounded-pill shadow-lg',
                                    'title' => 'Delete',
                                    'data-confirm' => 'Are you sure you want to delete this item?',
                                    'data-method' => 'post',
                                ]);
                            },
                        ],
                    ], 
                ],
                'summary' => '',
                'options' => ['class' => 'table table-bordered table-borderless'], // เพิ่มคลาส 'table-bordered' เพื่อให้แสดงเส้นกรอบ
                'tableOptions' => ['class' => 'table table-bordered table-headerless table-borderless'], // เพิ่มคลาส 'table-bordered' เพื่อให้แสดงเส้นกรอบ
            ]); ?>
            <div class="cartTotal" style="width: 100%; background-color:#0B0B45; color:#ececec; margin-top:10px;">
                
            </div>
        </div>
    </div>
    </center>



</body>

</html>