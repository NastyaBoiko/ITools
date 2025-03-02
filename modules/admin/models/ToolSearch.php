<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tool;

/**
 * ToolSearch represents the model behind the search form of `app\models\Tool`.
 */
class ToolSearch extends Tool
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'amount', 'min_amount', 'location_id', 'project_id', 'delete_status'], 'integer'],
            [['created_at', 'updated_at', 'title', 'serial_number', 'cell', 'inventory_time', 'qr'], 'safe'],
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
        $query = Tool::find();

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
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'min_amount' => $this->min_amount,
            'location_id' => $this->location_id,
            'project_id' => $this->project_id,
            'inventory_time' => $this->inventory_time,
            'delete_status' => $this->delete_status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'cell', $this->cell])
            ->andFilterWhere(['like', 'qr', $this->qr]);

        return $dataProvider;
    }
}
