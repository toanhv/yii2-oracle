<?php

use backend\models\ExchangeSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel ExchangeSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('backend', 'Cộng/trừ tiền');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agexchangehis-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'ID_MAPPING',
                'format' => 'raw', //raw, html
                'content' => function($data) {
                    return common\helpers\RemoveSign::decodeMsisdn($data->ID_MAPPING, $data->CP_NAME);
                }
            ],
            'CP_NAME',
            'VALUE',
            [
                'attribute' => 'TRANS_TYPE',
                'format' => 'raw', //raw, html
                'content' => function($data) {
                    return $data->TRANS_TYPE == 1 ? 'Cộng tiền' : 'Trừ tiền';
                }
            ],
            [
                'label' => 'Trạng thái',
                'attribute' => 'ERROR_CODE',
                'format' => 'raw', //raw, html
                'content' => function($data) {
                    return $data->ERROR_CODE === '0' ? 'Thành công' : 'Thất bại';
                }
            ],
            'INSERT_TIME',
        ],
    ]);
    ?>
</div>
