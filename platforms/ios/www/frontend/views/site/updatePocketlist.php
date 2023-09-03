<?php

use app\models\Expenses;
use app\models\Incomes;
use app\models\Pocket;
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

                                        <?php
                                        $expense_type = ArrayHelper::map(Typesexpense::find()->all(), 'type_name','type_name');
                                        echo $form->field($model, 'expense_type',[
                                            'inputOptions' => [
                                                'class' => 'form-control btn btn-light dropdown-toggle typeBlock',
                                            ]
                                        ])->dropDownList(
                                            $expense_type,
                                            [
                                                'prompt'=>'Select Types',
                                            ]
                                        )
                                        ?>
                                        <br/>
                                        <?= $form->field($model, 'expense_kind')->radioList(['regular' => 'Regular Expense', 'generale' => 'General Expense']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                $currentMonth = date('m');
                $currentYear = date('Y');
                $income = Incomes::find()
                ->where([
                     "create_by" => (String) Yii::$app->user->identity->id,
                ])
                ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
                ->all();
                $inlist = [];
                foreach ($income as $i) {
                    $inlist[] = $i->amount;
                }
                (int)$total_income = array_sum($inlist);

                $expense = Expenses::find()
                    ->where([
                        "create_by" => (String) Yii::$app->user->identity->id,
                    ])
                    ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
                    ->all();
                $exlist = [];
                foreach ($expense as $e) {
                    $exlist[] = $e->amount;
                }
                (int)$total_expense = array_sum($exlist);

                $balance = (int)$total_income - (int)$total_expense;

                $pockets = Pocket::find()->where(["user_id" => (String) Yii::$app->user->identity->id])->all();
                $totalRatio = 0;
                foreach ($pockets as $pocket) {
                    $totalRatio += (int) $pocket->ratio;
                }

            ?>
            <?php 
                // if ($model->status === 'added') : 
            ?>
                <div class="card o-hidden border-0 my-5 shadow typeBlock">
                    <div class="">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="row d-flex align-items-center justify-content-between">
                                        <div class="col-auto">
                                            <img src="https://cdn-icons-png.flaticon.com/512/755/755200.png" width="70px">
                                        </div>
                                        <div class="col">
                                            <?= 
                                            $form->field($model, 'ratio', [
                                                'inputOptions' => [
                                                    'class' => 'form-control form-control-user rounded-pill',
                                                ],
                                            ])->textInput(['autofocus' => true]) 
                                            ?>
                                            <span>THB</span>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="card typeBlock" style="width:100%">
                                        <div style="margin-top:10px; margin-bottom:10px;margin-left:15px;">
                                            <div class="row d-flex align-items-center justify-content-between" style="font-size:10px">
                                                <div class="col" style="margin-right:-10%;font-size:10px;">
                                                    Income/Expense
                                                </div>
                                                <div class="col" style="margin-right:-10%;">
                                                    Balance
                                                </div>
                                                <div class="col">
                                                    Pocket
                                                </div>
                                            </div>
                                            <div class="row d-flex align-items-center justify-content-between" style="font-size:11px">
                                                <div class="col" style="margin-right:-10%;">
                                                    <?= $total_income ?>/<?= $total_expense ?>
                                                </div>
                                                <div class="col" style="margin-right:-10%;">
                                                    <?= $balance ?>
                                                </div>
                                                <div class="col">
                                                    <?= $totalRatio ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
            // endif; 
            ?>

            <?= $form->field($model, 'create_date', [
                'inputOptions' => [
                    'class' => 'form-control form-control-user',
                ]
            ])->hiddenInput(['autofocus' => true])->label(false) ?>
            <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>

            <center>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-user rounded-pill shadow-lg']) ?>
            </center>
            <?php ActiveForm::end() ?>

        </div>
    </div>
</body>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

