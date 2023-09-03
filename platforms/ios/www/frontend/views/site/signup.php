<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Signup';
// $this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
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

<!-- https://cdn-icons-png.flaticon.com/512/4149/4149706.png -->

<body style="background-image: url('https://img.freepik.com/premium-photo/abstract-blurred-gradient-background-multi-color-mint-green-tiffany-blue-turquoise-color-background-banner-template_335640-3642.jpg?w=360');background-size: cover;background-position: center;">
    <div class="">
        <div class="site-signup">
            <div class="card o-hidden border-0 my-5 typeBlock">
                <div class="">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 mb-4 ">Create an Account!</h1>
                                </div>
                                <?php $form = ActiveForm::begin([
                                    'id' => 'form-signup',
                                    'options' => ['class' => 'user']
                                ]); ?>

                                    <?= $form->field($model, 'username', [
                                        'inputOptions' => [
                                            'class' => 'form-control form-control-user',
                                            'placholder' => 'Enter your username'
                                        ]
                                    ])->textInput(['autofocus' => true]) ?>

                                    <?= $form->field($model, 'email', [
                                        'inputOptions' => [
                                            'class' => 'form-control form-control-user',
                                            'placholder' => 'Enter your email'
                                        ]
                                    ]) ?>

                                    <?= $form->field($model, 'password', [
                                        'inputOptions' => [
                                            'class' => 'form-control form-control-user',
                                            'placholder' => 'Enter your password'
                                        ]
                                    ])->passwordInput() ?>

                                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'signup-button']) ?>
                                <?php ActiveForm::end() ?>
                            </div>
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