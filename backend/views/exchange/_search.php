<?php

use backend\models\ExchangeSearch;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model ExchangeSearch */
/* @var $form ActiveForm */
?>

<div class="active-form-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?=
    $form->field($model, 'fromTime')->widget(DatePicker::classname(), [
        'language' => 'vi',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => [
            //'readonly' => 'readonly',
            'style' => '',
        ]
    ])->label('Từ ngày')
    ?>

    <?=
    $form->field($model, 'toTime')->widget(DatePicker::classname(), [
        'language' => 'vi',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => [
            //'readonly' => 'readonly',
            'style' => '',
        ]
    ])->label('Đến ngày')
    ?>

    <?php echo $form->field($model, 'CP_NAME')->dropDownList(backend\models\AGCP::getAll()); ?>
    <?php echo $form->field($model, 'ID_MAPPING')->label('Số điện thoại'); ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
