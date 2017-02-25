<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AGMTHIS */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Agmthis',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Agmthis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agmthis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
