<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pocket;

/**
 * PocketSearch represents the model behind the search form of `app\models\Pocket`.
 */
class PocketSearch extends Pocket
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'pocket_name', 'expense_type', 'ratio', 'create_date', 'user_id', 'expense_kind','status'], 'safe'],
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
        $query = Pocket::find();

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
            ->andFilterWhere(['like', 'pocket_name', $this->pocket_name])
            ->andFilterWhere(['like', 'expense_type', $this->expense_type])
            ->andFilterWhere(['like', 'ratio', $this->ratio])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'expense_kind', $this->expense_kind])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider; 
    }

    public function pocket_search($user_id)
    {
        $query = Pocket::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'user_id', $user_id]);

        return $dataProvider;
    }
}
