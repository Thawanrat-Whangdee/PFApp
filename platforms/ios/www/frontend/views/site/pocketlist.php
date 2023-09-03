<?php


use app\models\Types;
use app\models\Typesexpense;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Expenses */
/* @var $form yii\widgets\ActiveForm */
?>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Hind+Siliguri:wght@300&family=Nunito&family=Open+Sans&family=Sarabun:wght@200&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .bg-register-image {
            background: url("https://img.freepik.com/premium-vector/vector-cartoon-business-finance-management-icon-comic-style-time-is-money-concept-illustration-pictogram-financial-strategy-business-splash-effect-concept_157943-5361.jpg?w=2000");
            background-position: center;
            background-size: cover;
        }
        .bg-register-color {
            background-image: url('https://webgradients.com/public/webgradients_png/010%20Winter%20Neva.png');
            background-size: cover;
        }
        .typeBlock {
            border-radius: 2rem;
            
        }
        .bg-color {
            background-color: #0B0B45;
            color:#ececec;
        }
        
    </style>
    <script src="https://kit.fontawesome.com/c3c7a2a31a.js" crossorigin="anonymous"></script>
</head>



<body style="background-color: #41DBC6;background-size: cover;background-position: center;">
    <div class="">
        <p>
            <?= Html::a('Add Pocket', ['pocket/create'], ['class' => 'btn btn-success btn-user rounded-pill', 'style' => 'width: 110px; text-align: left;']) ?>
        </p>
        <div class="site-signup">
            <div class="card o-hidden border-0 my-5 shadow typeBlock">
                <div class="">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                    
                    <div class="card" style="width: 100%; ">
                        <div class="container">
                            <?= Html::a('<i class="fa fa-chevron-left"></i>', ['/site/overview']); ?>
                            <h4 class="card-title" style="text-align:center;"><b>Your Pocket</b></h4>
                            <?= GridView::widget([
                                'dataProvider' => $pocketModel,
                                'columns' => [
                                    [
                                        'attribute' => 'pocket_name',
                                        'format' => 'raw',
                                        'contentOptions' => ['class' => ''],
                                        // 'header' => 'Image',
                                    ],
                                    // 'expense_type',
                                    [
                                        'attribute' => 'expense_type',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            return (empty($model->expense_type)) ? '<span style="color: red;">(not set)</span>' : $model->expense_type;
                                        },
                                    ],
                                    [
                                        'attribute' => 'ratio',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            return ($model->ratio === 0) ? '<span style="color: red;">(not set)</span>' : $model->ratio;
                                        },
                                    ],
                                    [
                                        'class' => ActionColumn::className(),
                                        'urlCreator' => function ($action, \app\models\Pocket $model, $key, $index, $column) {
                                            if ($action === 'update') {
                                                    return Url::toRoute(['site/update-pocketlist', '_id' => (string) $model->_id]);
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
                                                if(($expenseDay >= 2 && $expenseYear === $currentYear && $expenseMonth >= $currentMonth)) {
                                                    if (($model->status != 'added')) {
                                                        return Html::a('Set', $url, [
                                                            'class' => 'btn btn-primary rounded-pill shadow-lg btn-success',
                                                            'title' => 'Set',
                                                        ]);
                                                    } else {
                                                        return Html::a('Edit', $url, [
                                                            'class' => 'btn btn-warning rounded-pill shadow-lg btn-success',
                                                            'style' => 'color:white;',
                                                            'title' => 'Edit',
                                                        ]);
                                                    }
                                                }
                                            },
                                            'delete' => function ($url, $model, $key) {
                                                // Check if there are expenses with the same expense_type as the Pocket
                                                $hasExpenses = \app\models\Expenses::find()->where(['expense_type' => $model->expense_type])->exists();

                                                // ดึงวันที่, เดือน, และปีของ create_date จาก Expense
                                                $expenseDay = date('d', strtotime($model->create_date));
                                                $expenseMonth = date('m', strtotime($model->create_date));
                                                $expenseYear = date('Y', strtotime($model->create_date));
            
                                                // ดึงวันที่, เดือน, และปีปัจจุบัน
                                                $currentDay = date('d');
                                                $currentMonth = date('m');
                                                $currentYear = date('Y');
                                            
                                                if (($expenseDay >= 2 && $expenseYear === $currentYear && $expenseMonth >= $currentMonth)) {
                                                    if ($hasExpenses) {
                                                        return Html::a('<i class="fas fa-trash-alt"></i>', '#', [
                                                            'class' => 'btn btn-danger rounded-pill shadow-lg',
                                                            'title' => 'Delete',
                                                            'data-confirm' => 'There are expenses in this pocket. Cannot be deleted.',
                                                            'data-method' => 'post',
                                                            'disabled' => true, // Disable the link
                                                        ]);
                                                    } else {
                                                        $deleteUrl = Url::toRoute(['site/delete-pocket', '_id' => (string) $model->_id]);
                                                        return Html::a('<i class="fas fa-trash-alt"></i>', $deleteUrl, [
                                                            'class' => 'btn btn-danger rounded-pill shadow-lg',
                                                            'title' => 'Delete',
                                                            'data-confirm' => 'Are you sure you want to delete this item?',
                                                            'data-method' => 'post',
                                                        ]);
                                                    }
                                                }
                                            },
                                        ],
                                    ],
                                    
                                ],
                                'summary' => '',
                                'options' => ['class' => 'table table-bordered table-borderless'], // เพิ่มคลาส 'table-borderless' เพื่อซ่อนเส้นกรอบ
                                'tableOptions' => ['class' => 'table table-bordered table-borderless'], // เพิ่มคลาส 'table-borderless' เพื่อซ่อนเส้นกรอบ
                            ]); ?>
                            <div class="cartTotal" style="width: 100%; background-color:#0B0B45; color:#ececec; margin-top:10px;"></div>
                        </div>
                    </div>
                </div>
            </div>                            
        </div>
    </div>
</body>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
