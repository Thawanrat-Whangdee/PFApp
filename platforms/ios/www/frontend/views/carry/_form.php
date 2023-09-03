<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Carry $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="carry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
