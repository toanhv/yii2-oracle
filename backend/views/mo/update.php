<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AGMOHIS */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Agmohis',
]) . ' ' . $model->MO_HIS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Agmohis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MO_HIS_ID, 'url' => ['view', 'id' => $model->MO_HIS_ID]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="agmohis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
