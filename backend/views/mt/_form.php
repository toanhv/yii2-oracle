<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AGMTHIS */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agmthis-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'MT_HIS_ID')->textInput() ?>

    <?= $form->field($model, 'ISDN')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'MESSAGE')->textInput(['maxlength' => 2000]) ?>

    <?= $form->field($model, 'MO_TRANS_ID')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'MT_TRANS_ID')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'RETRY_COUNT')->textInput() ?>

    <?= $form->field($model, 'SENT_TIME')->textInput(['maxlength' => 7]) ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'APP_ID')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'RECEIVE_TIME')->textInput(['maxlength' => 7]) ?>

    <?= $form->field($model, 'CHANNEL')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'NODE_NAME')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'CLUSTER_NAME')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
