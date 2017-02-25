<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\VtUser */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
            'modelClass' => Yii::t('backend', 'Vt Users'),
        ]) . ' ' . $model->USERNAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Vt Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="vt-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_change', [
        'model' => $model,
    ])
    ?>

</div>
