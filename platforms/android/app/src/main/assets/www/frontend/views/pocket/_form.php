<?php

use app\models\Typesexpense;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\Pocket $model */
/** @var yii\widgets\ActiveForm $form */
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
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: initial !important;
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
                                    <h1 class="h4 text-gray-900 mb-4">Add Pocket</h1>
                                </div>
                                </br>
                                <div class="row d-flex align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <img src="https://cdn-icons-png.flaticon.com/128/2806/2806418.png" width="60px">
                                    </div>
                                    <div class="col">
                                        <?php $form = ActiveForm::begin([
                                            'id' => 'form-signup',
                                            'options' => ['class' => 'user']
                                        ]); ?>

                                        <?= $form->field($model, 'pocket_name', [
                                            'inputOptions' => [
                                                'class' => 'form-control form-control-user rounded-pill',
                                            ],
                                        ])->textInput(['autofocus' => true]) ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?= $form->field($model, 'create_date', [
                'inputOptions' => [
                    'class' => 'form-control form-control-user',
                ]
            ])->hiddenInput(['autofocus' => true])->label(false) ?>
            <?= $form->field($model, 'ratio', [
                'inputOptions' => [
                    'class' => 'form-control form-control-user',
                ]
            ])->hiddenInput(['autofocus' => true])->label(false) ?>
            <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>

            <center>
                <?= Html::submitButton('Add Pocket', ['class' => 'btn btn-success btn-user rounded-pill shadow-lg']) ?>
            </center>
            <?php ActiveForm::end() ?>

        </div>
    </div>
</body>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

