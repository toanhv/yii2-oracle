<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VtUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vt-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'USERNAME')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'password_old')->passwordInput()->label('Mật khẩu cũ') ?>

    <?= $form->field($model, 'PASSWORD_HASH')->passwordInput(['value' => ''])->label('Mật khẩu mới') ?>

    <?= $form->field($model, 're_password')->passwordInput()->label('Gõ lại mật khẩu mới') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
