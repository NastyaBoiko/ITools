<?php

namespace app\modules\account\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tool;
use app\models\ToolHistory;
use Yii;

/**
 * MyToolSearch represents the model behind the search form of `app\models\Tool`.
 */
class MyToolSearch extends Tool
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tool_maker_id', 'category_id', 'material_made_of_id', 'min_amount', 'location_id', 'project_id', 'delete_status'], 'integer'],
            [['created_at', 'updated_at', 'cell', 'inventory_time', 'qr'], 'safe'],
            [['diameter', 'full_length', 'work_length'], 'number'],
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
        // $currentUserId = Yii::$app->user->id;

        // $query = ToolHistory::find()
        //         ->with([
        //             'tool',
        //             'toolStatus', 
        //             'user',
        //         ])
        //         ->where(['tool_history.user_id' => 1])
        //         ;
        
        $query = Tool::find()
                ->innerJoin('tool_history', 'tool_history.tool_id = tool.id')
                ->with([
                    'toolHistories.toolStatus', 
                    'toolHistories.user',
                ])
                // ->where(['tool_history.user_id' => 1])
                ;

        // $query = ToolHistory::find()
        //             ->orderBy(['created_at' => SORT_DESC])
        //             ->limit(1)
        //             ;
        // dd($query->createCommand()->getRawSql());
        // $query->andWhere()


                
        // Customer::find()->with([
        //             'country',
        //             'orders' => function ($query) {
        //                 $query->andWhere(['status' => Order::STATUS_ACTIVE]);
        //             },
        //         ]);

        //         ->joinWith(['toolHistories' => function($query) use ($currentUserId) {
        //             $query->where(['tool_history.user_id' => $currentUserId]);
        //         }])

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 9,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC, 
                ]
            ],
        ]);

        // foreach ($dataProvider->getModels() as $key => $model) {
            // if (end($model->toolHistories)->user->id == Yii::$app->user->id) {

            // } else {
            //     dd($dataProvider);
            // }
        // }
        dd($dataProvider->getModels());

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
            'tool_maker_id' => $this->tool_maker_id,
            'category_id' => $this->category_id,
            'diameter' => $this->diameter,
            'full_length' => $this->full_length,
            'work_length' => $this->work_length,
            'material_made_of_id' => $this->material_made_of_id,
            'min_amount' => $this->min_amount,
            'location_id' => $this->location_id,
            'project_id' => $this->project_id,
            'inventory_time' => $this->inventory_time,
            'delete_status' => $this->delete_status,
        ]);

        $query->andFilterWhere(['like', 'cell', $this->cell])
            ->andFilterWhere(['like', 'qr', $this->qr]);

        return $dataProvider;
    }
}
