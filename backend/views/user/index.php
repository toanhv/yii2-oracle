<?php

use backend\models\UserSearch;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel UserSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('backend', 'Vt Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vt-user-index">

    <!--h1><?= Html::encode($this->title) ?></h1-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('backend', 'Create {modelClass}', [
                    'modelClass' => $this->title,
                ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'USERNAME',
            'EMAIL:email',
            [
                'attribute' => 'STATUS',
                'format' => 'raw', //raw, html
                'content' => function($data) {
                    return $data->STATUS == 1 ? 'Hoạt động' : 'Không hoạt động';
                },
                'filter' => [1 => 'Hoạt động', 0 => 'Không hoạt động'],
            ],
            'CREATED_AT',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
