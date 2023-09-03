<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Types;

/**
 * TypesSearch represents the model behind the search form of `app\models\Types`.
 */
class TypesSearch extends Types
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'income_type_name', 'expense_type_name', 'expense_id', 'income_id', 'user_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Types::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'income_type_name', $this->income_type_name])
            ->andFilterWhere(['like', 'expense_type_name', $this->expense_type_name])
            ->andFilterWhere(['like', 'expense_id', $this->expense_id])
            ->andFilterWhere(['like', 'income_id', $this->income_id])
            ->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}
