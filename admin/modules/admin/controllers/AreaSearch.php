<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AreaSearch represents the model behind the search form about `backend\models\Area`.
 */
class AreaSearch extends Area
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['area_id', 'area_name', 'created_by', 'modified_by'], 'integer'],
            [['created_datetime', 'modified_datetime', 'trash'], 'safe'],
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
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Area::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'area_id' => $this->area_id,
            'area_name' => $this->area_name,
            'created_by' => $this->created_by,
            'modified_by' => $this->modified_by,
            'created_datetime' => $this->created_datetime,
            'modified_datetime' => $this->modified_datetime,
        ]);

        $query->andFilterWhere(['like', 'trash', $this->trash]);

        return $dataProvider;
    }
}
