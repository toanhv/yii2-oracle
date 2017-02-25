<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['ID', 'STATUS'], 'integer'],
            [['USERNAME', 'EMAIL'], 'safe'],
            [['USERNAME', 'EMAIL'], 'trim'],
            //['STATUS', 'in', 'range' => [0, 1]],
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
        $query = User::find()->select(\common\models\USERADBase::$sql_query);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['USERNAME' => SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->ID,
            'status' => $this->STATUS,
            'created_at' => $this->CREATED_AT,
            'updated_at' => $this->UPDATED_AT,
        ]);

        $username = str_replace(\common\helpers\RemoveSign::$hasSign, \common\helpers\RemoveSign::$lowerSign, $this->USERNAME);
        $email = str_replace(\common\helpers\RemoveSign::$hasSign, \common\helpers\RemoveSign::$lowerSign, $this->EMAIL);

        $query->andFilterWhere(['like', 'lower(username)', strtolower($username)])
                ->andFilterWhere(['like', 'lower(email)', strtolower($email)]);

        return $dataProvider;
    }

}
