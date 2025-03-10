<?php

namespace app\modules\account\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tool;
use app\models\ToolHistory;

/**
 * ToolSearch represents the model behind the search form of `app\models\Tool`.
 */
class ToolSearch extends Tool
{
    public $status_id;
    public $user_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tool_maker_id', 'category_id', 'material_made_of_id', 'min_amount', 'location_id', 'project_id', 'delete_status', 'status_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at', 'cell', 'inventory_time', 'qr'], 'safe'],
            [['diameter', 'full_length', 'work_length'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'created_at' => 'Дата и время создания',
            'updated_at' => 'Дата последнего изменения',
            'tool_maker_id' => 'Производитель',
            'category_id' => 'Категория',
            'diameter' => 'Диаметр',
            'full_length' => 'Общая длина',
            'work_length' => 'Рабочая длина',
            'material_made_of_id' => 'Материал из чего',
            'materialsUseFor' => 'Материал для чего',
            'min_amount' => 'Минимально необходимое количество',
            'location_id' => 'Месторасположение',
            'status_id' => 'Статус',
            'user_id' => 'Ответственный',
            'cell' => 'Полка или ячейка',
            'project_id' => 'Проект',
            'inventory_time' => 'Дата и время инвентаризации',
            'delete_status' => 'Delete Status',
            'qr' => 'Qr-код',
            'imageFiles' => 'Изображения',
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
        $query = Tool::find()
                ->with(['toolHistories', 'toolHistories.toolStatus', 'toolHistories.user'])
                ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 8,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC, 
                ]
            ],
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

        if ($this->status_id) {
            $toolWithNeededStatusIds = ToolHistory::find()
                        ->select('tool_id')
                        // id in list lastToolHistoryIds
                        ->where(['id' => ToolHistory::lastToolHistoryIds()])
                        ->andWhere(['tool_status_id' => $this->status_id]) 
                        ;
            
            $query->andFilterWhere(['id' => $toolWithNeededStatusIds]);
        }

        if ($this->user_id) {
            $toolWithNeededUserIds = ToolHistory::find()
                        ->select('tool_id')
                        // id in list lastToolHistoryIds
                        ->where(['id' => ToolHistory::lastToolHistoryIds()])
                        ->andWhere(['user_id' => $this->user_id]) 
                        ;
            
            $query->andFilterWhere(['id' => $toolWithNeededUserIds]);
        }

        return $dataProvider;
    }
}
