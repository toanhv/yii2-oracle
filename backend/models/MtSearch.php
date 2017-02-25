<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AGMTHIS;

/**
 * MtSearch represents the model behind the search form about `backend\models\AGMTHIS`.
 */
class MtSearch extends AGMTHIS {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ISDN'], 'required'],
            [['ISDN', 'MESSAGE', 'MO_TRANS_ID', 'fromTime', 'SENT_TIME', 'toTime', 'RECEIVE_TIME', 'CHANNEL', 'NODE_NAME', 'CLUSTER_NAME'], 'safe'],
            [['ISDN', 'MESSAGE', 'MO_TRANS_ID', 'fromTime', 'SENT_TIME', 'toTime', 'RECEIVE_TIME', 'CHANNEL', 'NODE_NAME', 'CLUSTER_NAME'], 'trim'],
            [['fromTime', 'toTime'], 'date', 'format' => 'php:Y-m-d', 'message' => 'Định dạng thời gian không hợp lệ'],
            [['toTime'], 'compare', 'compareAttribute' => 'fromTime', 'operator' => '>=', 'type' => 'date', 'message' => Yii::t('backend', 'Đến ngày phải lớn hơn hoặc bằng Từ ngày')],
            [['ISDN'], 'match', 'pattern' => Yii::$app->params['viettel_phone_expression'],
                'message' => Yii::t('backend', 'Số điện thoại không đúng định dạng')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = AGMTHIS::find()
                ->select("mt_his_id, isdn, message, mo_trans_id, mt_trans_id,channel,node_name,cluster_name
                        retry_count, TO_CHAR(sent_time, 'YYYY-MM-DD HH24:MI:SS') as sent_time, status, app_id, 
                        TO_CHAR(receive_time, 'YYYY-MM-DD HH24:MI:SS') as receive_time");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['RECEIVE_TIME' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            $query->where('0=1');
            $this->clearErrors();
            return $dataProvider;
        }

        if (!$this->fromTime && $this->toTime) {
            $this->addError('fromTime', 'Bạn chưa nhập vào Từ ngày');
            $query->where('0=1');
            return $dataProvider;
        } elseif ($this->fromTime && !$this->toTime) {
            $this->addError('toTime', 'Bạn chưa nhập vào Đến ngày');
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ISDN' => \common\helpers\RemoveSign::convertMsisdn($this->ISDN),
        ]);

        $content = str_replace(\common\helpers\RemoveSign::$hasSign, \common\helpers\RemoveSign::$lowerSign, $this->MESSAGE);
        $query->andFilterWhere(['like', 'lower(MESSAGE)', strtolower($content)]);

        if ($this->fromTime && $this->toTime) {
            $query->andFilterWhere(['between', 'RECEIVE_TIME',
                new \yii\db\Expression("to_date('$this->fromTime','YYYY-MM-DD')"),
                new \yii\db\Expression("to_date('$this->toTime 23:59:59','YYYY-MM-DD HH24:MI:SS')")]);
        }

        return $dataProvider;
    }

}
