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

<body style="background-color: #41DBC6;background-size: cover;background-position: center;">
    <div class="">
        <div class="site-signup">
            <div class="card o-hidden border-0 my-5 shadow typeBlock">
                <div class="">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                    
                    <div class="card" style="width: 100%; ">
                        <div class="container">
                            <?= Html::a('<i class="fa fa-chevron-left"></i>', ['/site/overview']); ?>
                            <h4 class="card-title" style="text-align:center;"><b>Add Pocket</b></h4>
                            <?= GridView::widget([
                                'dataProvider' => $typesexpenseModel,
                                'columns' => [
                                    [
                                        'attribute' => 'type_name',
                                        'format' => 'raw',
                                        'contentOptions' => ['class' => ''],
                                        'value' => function ($model) {
                                            return '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2b/Circle-icons-compose.svg/1024px-Circle-icons-compose.svg.png" width="30px" height="30px">' . implode(",", (array)$model->type_name);
                                        },
                                        // 'header' => 'Image',
                                    ],
                                    // [
                                    //     'attribute' => 'amount',
                                    //     'format' => 'raw',
                                    //     'headerOptions' => ['class' => 'text-center'],
                                    //     'contentOptions' => ['class' => 'text-center'],
                                    // ],
                                    [
                                        'class' => ActionColumn::className(),
                                        'urlCreator' => function ($action, \app\models\Typesexpense $model, $key, $index, $column) {
                                            if ($action === 'update') {
                                                    return Url::toRoute(['site/update-pocket', '_id' => (string) $model->_id]);
                                                } 
                                            return Url::toRoute([$action, '_id' => (string) $model->_id]);
                                        },
                                        'visibleButtons' => [
                                            'view' => false,
                                            'delete' => false
                                        ],
                                        // 'contentOptions' => ['class' => 'text-right'],
                                        'buttons' => [
                                            'update' => function ($url, $model, $key) {
                                                if ($model->status === 'added') {
                                                    return Html::a('Add Ratio', $url, [
                                                        'class' => 'btn btn-primary rounded-pill shadow-lg btn-success',
                                                        'title' => 'Add Ratio',
                                                    ]);
                                                } else {
                                                    return Html::a('Add Pocket', $url, [
                                                        'class' => 'btn btn-primary rounded-pill shadow-lg',
                                                        'title' => 'Add Pocket',
                                                    ]);
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
