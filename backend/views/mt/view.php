<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AGMTHIS */

$this->title = $model->MT_HIS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Agmthis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agmthis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->MT_HIS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->MT_HIS_ID], [
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
                'MT_HIS_ID',
            'ISDN',
            'MESSAGE',
            'MO_TRANS_ID',
            'MT_TRANS_ID',
            'RETRY_COUNT',
            'SENT_TIME',
            'STATUS',
            'APP_ID',
            'RECEIVE_TIME',
            'CHANNEL',
            'NODE_NAME',
            'CLUSTER_NAME',
    ],
    ]) ?>
    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->MT_HIS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->MT_HIS_ID], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
        'method' => 'post',
        ],
        ]) ?>
    </p>
</div>
