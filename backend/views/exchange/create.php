<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AGEXCHANGEHIS */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Agexchangehis',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Agexchangehis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agexchangehis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
