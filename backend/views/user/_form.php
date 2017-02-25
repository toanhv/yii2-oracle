<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VtUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vt-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= ($model->isNewRecord) ? $form->field($model, 'USERNAME')->textInput(['maxlength' => 255]) : '' ?>

    <?= $form->field($model, 'PASSWORD_HASH')->passwordInput(['value' => '']) ?>

    <?= $form->field($model, 're_password')->passwordInput() ?>

    <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'STATUS')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
