<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AGEXCHANGEHIS */

$this->title = $model->EXCHANGE_HIS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Agexchangehis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agexchangehis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->EXCHANGE_HIS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->EXCHANGE_HIS_ID], [
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
                'EXCHANGE_HIS_ID',
            'ID_MAPPING',
            'TYPE',
            'VALUE',
            'USERNAME',
            'PROCESS_TIME',
            'INSERT_TIME',
            'BAL_TYPE',
            'TRANS_ID',
            'FEE',
            'CP_NAME',
            'TRANS_TYPE',
    ],
    ]) ?>
    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->EXCHANGE_HIS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->EXCHANGE_HIS_ID], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
        'method' => 'post',
        ],
        ]) ?>
    </p>
</div>
