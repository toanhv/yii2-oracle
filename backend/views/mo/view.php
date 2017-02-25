<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AGMOHIS */

$this->title = $model->MO_HIS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Agmohis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agmohis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->MO_HIS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->MO_HIS_ID], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
        'method' => 'post',
        ],
        ]) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'MO_HIS_ID',
            'ISDN',
            'CONTENT',
            'STATUS',
            'PROCESS_TIME',
            'APP_ID',
            'CHANNEL',
            'RECEIVE_TIME',
            'NODE_NAME',
            'CLUSTER_NAME',
            'MO_TRANS_ID',
    ],
    ]) ?>
    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->MO_HIS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->MO_HIS_ID], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
        'method' => 'post',
        ],
        ]) ?>
    </p>
</div>
