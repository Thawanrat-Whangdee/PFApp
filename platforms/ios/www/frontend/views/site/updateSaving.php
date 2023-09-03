<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Savings */
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
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Saving</h1>
                                </div>
                                <div class="row d-flex align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <img src="https://cdn-icons-png.flaticon.com/512/344/344464.png" width="50px">
                                    </div>
                                    <div class="col">
                                    <br/>
                                    <?php $form = ActiveForm::begin([
                                    'id' => 'form-signup',
                                    'options' => ['class' => 'user']
                                    ]); ?>
                                    <?= $form->field($model, 'amount', [
                                        'inputOptions' => [
                                            'class' => 'form-control form-control-user rounded-pill',
                                        ]
                                    ])->textInput(['autofocus' => true]) ?>
                                    <span>THB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card o-hidden border-0 my-5 shadow typeBlock">
                <div class="">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="row d-flex align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3094/3094766.png" width="50px">
                                    </div>
                                    <div class="col">
                                    <?= $form->field($model, 'start_date')->widget(
                                                DatePicker::className(), [
                                                    'options' => ['class' => 'form-control rounded-pill'],
                                                    'clientOptions' => [
                                                        'autoclose' => true,
                                                        'format' => 'yyyy-mm-dd',
                                                        'todayBtn' => true,
                                                        'todayHighlight' => true,
                                                        'showClear' => true,
                                                        'clearBtn' => true,
                                                        'language' => 'en', 
                                                        'startDate' => 'today',
                                                    ],
                                                    
                                                ]
                                        ); ?>

                                        <?= $form->field($model, 'end_date')->widget(
                                            DatePicker::className(), [
                                                'options' => ['class' => 'form-control rounded-pill'],
                                                'clientOptions' => [
                                                    'autoclose' => true,
                                                    'startView' => 'year', // เริ่มแสดงเป็นปฏิทินของปี
                                                    'minViewMode' => 'months', // ให้ปฏิทินแสดงเฉพาะเดือน
                                                    'format' => 'yyyy-mm', // รูปแบบที่ให้แสดงใน Input (เฉพาะปีและเดือน)
                                                    'todayBtn' => true,
                                                    'todayHighlight' => true,
                                                    'showClear' => true,
                                                    'clearBtn' => true,
                                                    'language' => 'en', 
                                                    'startDate' => 'today',
                                                ],
                                            ]
                                        ); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $form->field($model, 'user_id')->hiddenInput(['value'=> Yii::$app->user->identity->id])->label(false) ?>
            <?= Html::submitButton('Update', ['class' => 'btn btn-success btn-user btn-block rounded-pill shadow-lg']) ?>
            <?php ActiveForm::end() ?>                                   
        </div>
    </div>
</body>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
