<?php

/** @var yii\web\View $this */

use app\models\Carry;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Expenses;
use app\controllers\ExpensesController;

$this->title = 'expense';
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

        .cartTotal {
            width: 150px;
            height: 560;
            border-radius: 10px;
            text-align: center;
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
        .table-headerless thead {
            display: none;
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
        
        <!-- ------------------------------------------------Expense---------------------------------------- -->
        <div class="card" style="width: 100%;">
            <div class="container">
                <div style="margin-right: 300px; margin-top: 10px;">
                    <?= Html::a('<i class="fa fa-chevron-left"></i>', ['/site/calendar']); ?>
                </div>

                
                <h4 class="card-title"><b>Expense List</b></h4>
                <p><?= $date ?></p>   
                <?php 
                $date = Yii::$app->request->get('date');
                $expensesQuery = \app\models\Expenses::find()->where(['create_date' => $date]);

                // สร้าง DataProvider จาก Query ที่กรองไว้
                $expenseDataProvider = new \yii\data\ActiveDataProvider([
                    'query' => $expensesQuery,
                    'sort' => ['defaultOrder' => ['create_date' => SORT_DESC]],
                ]);
                
                echo GridView::widget([
                    'dataProvider' => $expenseDataProvider,
                    'columns' => [
                        [
                            'attribute' => 'expense_type',
                            'format' => 'raw',
                            'contentOptions' => ['class' => ''],
                            'value' => function ($model) {
                                return implode(",", (array)$model->expense_type);
                            },
                        ],
                        // 'amount',
                        [
                            'attribute' => 'amount',
                            'format' => 'raw',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, \app\models\Expenses $model, $key, $index, $column) {
                                if ($action === 'update') {
                                    return Url::toRoute(['site/update-expense', '_id' => (string) $model->_id]);
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
                                     // ดึงวันที่, เดือน, และปีของ create_date จาก Expense
                                    $expenseDay = date('d', strtotime($model->create_date));
                                    $expenseMonth = date('m', strtotime($model->create_date));
                                    $expenseYear = date('Y', strtotime($model->create_date));

                                    // ดึงวันที่, เดือน, และปีปัจจุบัน
                                    $currentDay = date('d');
                                    $currentMonth = date('m');
                                    $currentYear = date('Y');
                                
                                    // ตรวจสอบเงื่อนไขการแสดงปุ่ม 'update'
                                    if (($expenseDay >= 2 && $expenseYear === $currentYear && $expenseMonth >= $currentMonth)) {
                                        return Html::a('<i class="fas fa-pencil-alt fa-xs"></i>', $url, [
                                            'class' => 'btn btn-primary rounded-pill shadow-lg',
                                            'title' => 'Edit',
                                        ]);
                                    } else {
                                        return '';
                                    }
                                },
                                'delete' => function ($url, $model, $key) {
                                     // ดึงวันที่, เดือน, และปีของ create_date จาก Expense
                                     $expenseDay = date('d', strtotime($model->create_date));
                                     $expenseMonth = date('m', strtotime($model->create_date));
                                     $expenseYear = date('Y', strtotime($model->create_date));
 
                                     // ดึงวันที่, เดือน, และปีปัจจุบัน
                                     $currentDay = date('d');
                                     $currentMonth = date('m');
                                     $currentYear = date('Y');
                
                                    // ตรวจสอบเงื่อนไขการแสดงปุ่ม 'delete'
                                    if (($expenseDay >= 2 && $expenseYear === $currentYear && $expenseMonth >= $currentMonth)) {
                                        $deleteUrl = Url::toRoute(['site/delete-expense', '_id' => (string) $model->_id]);
                                        return Html::a('<i class="fas fa-trash-alt"></i>', $deleteUrl, [
                                            'class' => 'btn btn-danger rounded-pill shadow-lg',
                                            'title' => 'Delete',
                                            'data-confirm' => 'Are you sure you want to delete this item?',
                                            'data-method' => 'post',
                                        ]);
                                    } else {
                                        return '';
                                    }
                                },
                            ],
                        ], 
                    ],
                    'summary' => '',
                    'options' => ['class' => 'table table-bordered table-borderless'], // เพิ่มคลาส 'table-bordered' เพื่อให้แสดงเส้นกรอบ
                    'tableOptions' => ['class' => 'table table-bordered table-headerless table-borderless'], // เพิ่มคลาส 'table-bordered' เพื่อให้แสดงเส้นกรอบ
                    
                ]); 
                $totalAmountex = 0;
                foreach ($expenseDataProvider->getModels() as $model) {
                    $totalAmountex += $model->amount;
                }
                echo "<b>Total : </b>";
                echo $totalAmountex .' THB';
                ?>
                <div class="cartTotal" style="width: 100%; background-color:; color:; margin-top:10px;">
                    <!-- Button to scroll to Incomes List -->
                    <a href="#incomes-section" class="fa fa-chevron-down"></a>
                </div>
            </div>
        </div>


        <!-- ------------------------------------------------Incomes---------------------------------------- -->
        <div class="card" style="width: 100%;">
            <div class="container">
                <div style="margin-right: 300px; margin-top: 10px;">
                    <?= Html::a('<i class="fa fa-chevron-left"></i>', ['/site/calendar']); ?>
                </div>

                
                <h4 class="card-title"><b>Incomes List</b></h4>
                <p><?= $date ?></p>   
                <?php 
                $date = Yii::$app->request->get('date');
                $incomesQuery = \app\models\Incomes::find()->where(['create_date' => $date]);

                // สร้าง DataProvider จาก Query ที่กรองไว้
                $incomesDataProvider = new \yii\data\ActiveDataProvider([
                    'query' => $incomesQuery,
                    'sort' => ['defaultOrder' => ['create_date' => SORT_DESC]],
                ]);

                echo GridView::widget([
                    'dataProvider' => $incomesDataProvider,
                    'columns' => [
                        [
                            'attribute' => 'income_type',
                            'format' => 'raw',
                            'contentOptions' => ['class' => ''],
                            'value' => function ($model) {
                                return implode(",", (array)$model->income_type);
                            },
                        ],
                        // 'amount',
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
                                     // ดึงวันที่, เดือน, และปีของ create_date จาก Expense
                                    $expenseDay = date('d', strtotime($model->create_date));
                                    $expenseMonth = date('m', strtotime($model->create_date));
                                    $expenseYear = date('Y', strtotime($model->create_date));

                                    // ดึงวันที่, เดือน, และปีปัจจุบัน
                                    $currentDay = date('d');
                                    $currentMonth = date('m');
                                    $currentYear = date('Y');
                                
                                    // ตรวจสอบเงื่อนไขการแสดงปุ่ม 'update'
                                    if (($expenseDay >= 2 && $expenseYear === $currentYear && $expenseMonth >= $currentMonth)) {
                                        return Html::a('<i class="fas fa-pencil-alt fa-xs"></i>', $url, [
                                            'class' => 'btn btn-primary rounded-pill shadow-lg',
                                            'title' => 'Edit',
                                        ]);
                                    } else {
                                        return '';
                                    }
                                },
                                'delete' => function ($url, $model, $key) {
                                     // ดึงวันที่, เดือน, และปีของ create_date จาก Expense
                                     $expenseDay = date('d', strtotime($model->create_date));
                                     $expenseMonth = date('m', strtotime($model->create_date));
                                     $expenseYear = date('Y', strtotime($model->create_date));
 
                                     // ดึงวันที่, เดือน, และปีปัจจุบัน
                                     $currentDay = date('d');
                                     $currentMonth = date('m');
                                     $currentYear = date('Y');
                
                                    // ตรวจสอบเงื่อนไขการแสดงปุ่ม 'delete'
                                    if (($expenseDay >= 2 && $expenseYear === $currentYear && $expenseMonth >= $currentMonth)) {
                                        $deleteUrl = Url::toRoute(['site/delete-expense', '_id' => (string) $model->_id]);
                                        return Html::a('<i class="fas fa-trash-alt"></i>', $deleteUrl, [
                                            'class' => 'btn btn-danger rounded-pill shadow-lg',
                                            'title' => 'Delete',
                                            'data-confirm' => 'Are you sure you want to delete this item?',
                                            'data-method' => 'post',
                                        ]);
                                    } else {
                                        return '';
                                    }
                                },
                            ],
                        ], 
                    ],
                    'summary' => '',
                    'options' => ['class' => 'table table-bordered table-borderless'], // เพิ่มคลาส 'table-bordered' เพื่อให้แสดงเส้นกรอบ
                    'tableOptions' => ['class' => 'table table-bordered table-headerless table-borderless'], // เพิ่มคลาส 'table-bordered' เพื่อให้แสดงเส้นกรอบ
                    
                ]); 
                $totalAmountin = 0;
                foreach ($incomesDataProvider->getModels() as $model) {
                    $totalAmountin += $model->amount;
                }
                echo "<b>Total : </b>";
                echo $totalAmountin .' THB';
                ?>
                <div class="cartTotal" style="width: 100%; background-color:; color:; margin-top:10px;">
                    <!-- Button to scroll back to the top -->
                    <a href="#" class="fa fa-chevron-up"></a>
                </div>
            </div>
        </div>
    </center>


</body>

</html>