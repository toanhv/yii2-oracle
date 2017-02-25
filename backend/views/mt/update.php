<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AGMTHIS */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Agmthis',
]) . ' ' . $model->MT_HIS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Agmthis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MT_HIS_ID, 'url' => ['view', 'id' => $model->MT_HIS_ID]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="agmthis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
