<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Typesexpense;

/**
 * TypesexpenseSearch represents the model behind the search form of `app\models\Typesexpense`.
 */
class TypesexpenseSearch extends Typesexpense
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id', 'type_name', 'status','ratio','user_id','create_date','expense_kind'], 'safe'],
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
        $query = Typesexpense::find();

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
            ->andFilterWhere(['like', 'type_name', $this->type_name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'ratio', $this->ratio])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'expense_kind', $this->expense_kind]);


        return $dataProvider;
    } 

    public function type_expense_search($params)
    {
        $query = Typesexpense::find();

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
        $query->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}


