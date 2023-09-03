<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Types */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'income_type_name') ?>

    <?= $form->field($model, 'expense_type_name') ?>

    <?= $form->field($model, 'expense_id') ?>

    <?= $form->field($model, 'income_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
