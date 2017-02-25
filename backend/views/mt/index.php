<?php

use backend\models\MtSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel MtSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('backend', 'Tra cứu MT');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agmthis-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ISDN',
            'MESSAGE',
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
