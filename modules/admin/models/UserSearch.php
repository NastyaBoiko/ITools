<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    public $register_start = '';
    public $register_end = '';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'role_id'], 'integer'],
            [['created_at', 'name', 'surname', 'patronymic', 'email', 'password', 'phone', 'auth_key'], 'safe'],
            [['register_start', 'register_end'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'created_at' => 'Дата регистрации',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'Почта',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'phone' => 'Телефон',
            'role_id' => 'Роль',
            'auth_key' => 'Код аутентификации',
            'register_start' => 'Дата регистрации от',
            'register_end' => 'Дата регистрации до',
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
        $query = User::find();

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
            'role_id' => $this->role_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key]);

        // Фильтрация времени регистрации
        if ($this->register_start && $this->register_end) {
            $query->andFilterWhere([
                'between',
                'created_at',
                $this->register_start . ' 00:00:00',
                $this->register_end . ' 23:59:59',
            ]);
        } elseif ($this->register_start) {
            $query->andFilterWhere([
                '>',
                'created_at',
                $this->register_start . ' 00:00:00',
            ]);
        } elseif ($this->register_end) {
            $query->andFilterWhere([
                '<',
                'created_at',
                $this->register_end . ' 23:59:59',
            ]);
        }

        return $dataProvider;
    }
}
