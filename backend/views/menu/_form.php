<?php

use backend\models\Menu;
use mdm\admin\AutocompleteAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Menu2 */
/* @var $form ActiveForm */
$menus = Menu::find()->all();
$source[''] = 'Menu cha';
foreach ($menus as $item) {
    if (!$item->PARENT) {
        $source[$item->ID] = Html::encode($item->NAME);
    }
}
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'PARENT')->dropDownList($source) ?>

    <?= $form->field($model, 'ROUTE')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'PRIORITY')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
AutocompleteAsset::register($this);

$options2 = Json::htmlEncode([
            'source' => mdm\admin\models\Menu::getSavedRoutes()
        ]);
$this->registerJs("$('#menu-route').autocomplete($options2);");
