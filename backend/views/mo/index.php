<?php

use backend\models\MoSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel MoSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('backend', 'Tra cứu MO');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agmohis-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ISDN',
            'CONTENT:raw:MO',
            'mt.MESSAGE:raw:MT',
            [
                'attribute' => 'STATUS',
                'format' => 'raw', //raw, html
                'content' => function($data) {
                    return $data->STATUS === 0 ? 'Thành công' : 'Thất bại';
                }
            ],
            'CHANNEL',
            'RECEIVE_TIME',
        ],
    ]);
    ?>
</div>
