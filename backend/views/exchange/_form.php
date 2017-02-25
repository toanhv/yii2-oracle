<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AGEXCHANGEHIS */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agexchangehis-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'EXCHANGE_HIS_ID')->textInput() ?>

    <?= $form->field($model, 'ID_MAPPING')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'TYPE')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'VALUE')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'USERNAME')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'PROCESS_TIME')->textInput(['maxlength' => 7]) ?>

    <?= $form->field($model, 'INSERT_TIME')->textInput(['maxlength' => 7]) ?>

    <?= $form->field($model, 'BAL_TYPE')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'TRANS_ID')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'FEE')->textInput() ?>

    <?= $form->field($model, 'CP_NAME')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'TRANS_TYPE')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
