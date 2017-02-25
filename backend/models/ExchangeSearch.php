<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AGEXCHANGEHIS;

/**
 * ExchangeSearch represents the model behind the search form about `backend\models\AGEXCHANGEHIS`.
 */
class ExchangeSearch extends AGEXCHANGEHIS {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ID_MAPPING'], 'required'],
            [['ID_MAPPING', 'TYPE', 'VALUE', 'USERNAME', 'PROCESS_TIME', 'INSERT_TIME', 'fromTime', 'toTime', 'CP_NAME', 'TRANS_TYPE'], 'safe'],
            [['ID_MAPPING', 'TYPE', 'VALUE', 'USERNAME', 'PROCESS_TIME', 'INSERT_TIME', 'fromTime', 'toTime', 'CP_NAME', 'TRANS_TYPE'], 'trim'],
            [['fromTime', 'toTime'], 'date', 'format' => 'php:Y-m-d', 'message' => 'Định dạng thời gian không hợp lệ'],
            [['toTime'], 'compare', 'compareAttribute' => 'fromTime', 'operator' => '>=', 'type' => 'date', 'message' => Yii::t('backend', 'Đến ngày phải lớn hơn hoặc bằng Từ ngày')],
            [['ID_MAPPING'], 'match', 'pattern' => Yii::$app->params['viettel_phone_expression'], 'message' => Yii::t('backend', 'Số điện thoại không đúng định dạng')],
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
        $query = AGEXCHANGEHIS::find()
                ->select("exchange_his_id,id_mapping,type,value,username,bal_type,trans_id,fee,cp_name,trans_type,error_code,topup_trans_id,
                        TO_CHAR(process_time, 'YYYY-MM-DD HH24:MI:SS') as process_time, TO_CHAR(insert_time, 'YYYY-MM-DD HH24:MI:SS') as insert_time");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['INSERT_TIME' => SORT_DESC]]
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
            'ID_MAPPING' => \common\helpers\RemoveSign::encodeMsisdn($this->ID_MAPPING, $this->CP_NAME),
        ]);

        if ($this->fromTime && $this->toTime) {
            $query->andFilterWhere(['between', 'INSERT_TIME',
                new \yii\db\Expression("to_date('$this->fromTime','YYYY-MM-DD')"),
                new \yii\db\Expression("to_date('$this->toTime 23:59:59','YYYY-MM-DD HH24:MI:SS')")]);
        }

        return $dataProvider;
    }

}
