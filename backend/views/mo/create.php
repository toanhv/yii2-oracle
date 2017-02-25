<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AGMOHIS */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Agmohis',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Agmohis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agmohis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
