<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tool_history".
 *
 * @property int $id
 * @property string $created_at
 * @property int $tool_status_id
 * @property int $tool_id
 * @property int $user_id
 *
 * @property Tool $tool
 * @property ToolStatus $toolStatus
 * @property User $user
 */
class ToolHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tool_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['tool_status_id', 'tool_id', 'user_id'], 'required'],
            [['tool_status_id', 'tool_id', 'user_id'], 'integer'],
            [['tool_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tool::class, 'targetAttribute' => ['tool_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['tool_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ToolStatus::class, 'targetAttribute' => ['tool_status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'tool_status_id' => 'Tool Status ID',
            'tool_id' => 'Tool ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Tool]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTool()
    {
        return $this->hasOne(Tool::class, ['id' => 'tool_id']);
    }

    /**
     * Gets query for [[ToolStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToolStatus()
    {
        return $this->hasOne(ToolStatus::class, ['id' => 'tool_status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function lastToolHistoryIds()
    {
        return self::find()
            ->select('MAX(id)')
            ->groupBy('tool_id');
    }

    public static function toolWithNeededParameterIds(string $parameter, string $value)
    {
        return self::find()
            ->select('tool_id')
            // id in list lastToolHistoryIds
            ->where(['id' => self::lastToolHistoryIds()])
            ->andWhere([$parameter => $value])
        ;
    }

    public static function getLastUser($toolId)
    {
        $toolHistory = self::find()
            ->select('*')
            // id in list lastToolHistoryIds
            ->where(['id' => self::lastToolHistoryIds()])
            ->andWhere(['tool_id' => $toolId])
            ->one();

        return $toolHistory?->user ?? null;
    }

    public static function getLastStatus($toolId)
    {
        $toolHistory = self::find()
            ->select('*')
            // id in list lastToolHistoryIds
            ->where(['id' => self::lastToolHistoryIds()])
            ->andWhere(['tool_id' => $toolId])
            ->one();

        return $toolHistory?->toolStatus ?? null;
    }

    public static function getMonthlyStatistics()
    {
        return self::find()
            ->select([
                'YEAR(created_at) AS year',
                'MONTH(created_at) AS month',
                'tool_status_id',
                'ts.title AS status_title', // Добавляем название статуса
                'COUNT(*) AS count',
            ])
            ->joinWith('toolStatus ts') // Присоединяем таблицу tool_status
            ->groupBy(['YEAR(created_at)', 'MONTH(created_at)', 'tool_status_id', 'ts.title'])
            ->orderBy(['year' => SORT_ASC, 'month' => SORT_ASC, 'tool_status_id' => SORT_ASC])
            ->asArray()
            ->all();
    }

    public static function getUserToolStatistics($startDate, $endDate)
    {
        return self::find()
            ->alias('th') // Добавляем алиас th
            ->select([
                'u.id AS user_id',
                'u.surname',
                'u.name',
                'u.patronymic',
                'COUNT(th.tool_id) AS tool_count',
            ])
            ->joinWith('user u')
            ->where(['between', 'th.created_at', $startDate, $endDate])
            ->groupBy('u.id')
            ->orderBy(['tool_count' => SORT_DESC])
            ->asArray()
            ->all();
    }
}
