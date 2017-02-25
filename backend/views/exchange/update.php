<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AGEXCHANGEHIS */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Agexchangehis',
]) . ' ' . $model->EXCHANGE_HIS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Agexchangehis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->EXCHANGE_HIS_ID, 'url' => ['view', 'id' => $model->EXCHANGE_HIS_ID]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="agexchangehis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
