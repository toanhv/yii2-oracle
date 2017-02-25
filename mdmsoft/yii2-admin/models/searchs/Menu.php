<?php

namespace mdm\admin\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use mdm\admin\models\Menu as MenuModel;

/**
 * Menu represents the model behind the search form about [[\mdm\admin\models\Menu]].
 * 
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Menu extends MenuModel {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ID', 'PARENT', 'PRIORITY'], 'integer'],
            [['NAME', 'ROUTE', 'parent_name'], 'safe'],
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
     * Searching menu
     * @param  array $params
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params) {
        $query = MenuModel::find()
                ->from(MenuModel::tableName() . ' t')
                ->joinWith(['menuParent' => function ($q) {
                $q->from(MenuModel::tableName() . ' parent');
            }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $sort = $dataProvider->getSort();
        $sort->attributes['menuParent.NAME'] = [
            'asc' => ['parent.NAME' => SORT_ASC],
            'desc' => ['parent.NAME' => SORT_DESC],
            'label' => 'parent',
        ];
        $sort->attributes['order'] = [
            'asc' => ['parent.PRIORITY' => SORT_ASC, 't.PRIORITY' => SORT_ASC],
            'desc' => ['parent.PRIORITY' => SORT_DESC, 't.PRIORITY' => SORT_DESC],
            'label' => 'order',
        ];
        $sort->defaultOrder = ['menuParent.NAME' => SORT_ASC];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            't.id' => $this->ID,
            't.parent' => $this->PARENT,
        ]);

        $query->andFilterWhere(['like', 'lower(t.name)', strtolower($this->NAME)])
                ->andFilterWhere(['like', 't.route', $this->ROUTE])
                ->andFilterWhere(['like', 'lower(parent.name)', strtolower($this->parent_name)]);

        return $dataProvider;
    }

}
