<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
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


<body style="background-image: url('https://img.freepik.com/premium-photo/mint-green-purple-color-background-abstract-blurred-gradient-background-banner-template-mesh-backdrop-with-sweet-colors_335640-3361.jpg');background-size: cover;background-position: center;">
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
                                    <h1 class="h4 mb-4 ">Log in!</h1>
                                </div>
                                    <?php $form = ActiveForm::begin([
                                        'id' => 'login-form',
                                        'options' => ['class' => 'user']
                                    ]); ?>
                                        <?= $form->field($model, 'username', [
                                            'inputOptions' => [
                                                'class' => 'form-control form-control-user',
                                                'placholder' => 'Enter your username'
                                            ]
                                        ])->textInput(['autofocus' => true]) ?>

                                        <?= $form->field($model, 'password', [
                                            'inputOptions' => [
                                                'class' => 'form-control form-control-user',
                                                'placholder' => 'Enter your password'
                                            ]
                                        ])->passwordInput() ?>


                                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>
                                    <?php ActiveForm::end() ?>
                                </div>
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
