<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $created_at
 * @property int|null $tool_id
 * @property string|null $tool_other
 * @property int $amount
 * @property int|null $project_id
 * @property string $deadline_at
 * @property int $order_status_id
 * @property int $user_id
 * @property string|null $comment_admin
 *
 * @property OrderStatus $orderStatus
 * @property Project $project
 * @property Tool $tool
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'deadline_at'], 'safe'],
            [['tool_id', 'amount', 'project_id', 'order_status_id', 'user_id'], 'integer'],
            [['amount', 'deadline_at', 'order_status_id', 'user_id'], 'required'],
            [['tool_other', 'comment_admin'], 'string', 'max' => 255],
            [['order_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::class, 'targetAttribute' => ['order_status_id' => 'id']],
            [['tool_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tool::class, 'targetAttribute' => ['tool_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
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
            'tool_id' => 'Tool ID',
            'tool_other' => 'Tool Other',
            'amount' => 'Amount',
            'project_id' => 'Project ID',
            'deadline_at' => 'Deadline At',
            'order_status_id' => 'Order Status ID',
            'user_id' => 'User ID',
            'comment_admin' => 'Comment Admin',
        ];
    }

    /**
     * Gets query for [[OrderStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderStatus()
    {
        return $this->hasOne(OrderStatus::class, ['id' => 'order_status_id']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
