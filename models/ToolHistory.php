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
}
