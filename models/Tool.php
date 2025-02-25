<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tool".
 *
 * @property int $id
 * @property string $created_at
 * @property string|null $updated_at
 * @property string $title
 * @property int $category_id
 * @property int $amount
 * @property int $min_amount Для уведомлений, что нужно докупить
 * @property string $serial_number
 * @property int $location_id
 * @property int|null $project_id
 * @property string|null $inventory_time
 * @property int $delete_status 0 - не удален, 1 - удален
 * @property string|null $qr
 *
 * @property Category $category
 * @property Location $location
 * @property Order[] $orders
 * @property Project $project
 * @property ToolComment[] $toolComments
 * @property ToolHistory[] $toolHistories
 * @property ToolImage[] $toolImages
 */
class Tool extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tool';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'inventory_time'], 'safe'],
            [['title', 'category_id', 'amount', 'min_amount', 'serial_number', 'location_id'], 'required'],
            [['category_id', 'amount', 'min_amount', 'location_id', 'project_id', 'delete_status'], 'integer'],
            [['title', 'serial_number', 'qr'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location_id' => 'id']],
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
            'updated_at' => 'Updated At',
            'title' => 'Title',
            'category_id' => 'Category ID',
            'amount' => 'Amount',
            'min_amount' => 'Min Amount',
            'serial_number' => 'Serial Number',
            'location_id' => 'Location ID',
            'project_id' => 'Project ID',
            'inventory_time' => 'Inventory Time',
            'delete_status' => 'Delete Status',
            'qr' => 'Qr',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::class, ['id' => 'location_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['tool_id' => 'id']);
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
     * Gets query for [[ToolComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToolComments()
    {
        return $this->hasMany(ToolComment::class, ['tool_id' => 'id']);
    }

    /**
     * Gets query for [[ToolHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToolHistories()
    {
        return $this->hasMany(ToolHistory::class, ['tool_id' => 'id']);
    }

    /**
     * Gets query for [[ToolImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToolImages()
    {
        return $this->hasMany(ToolImage::class, ['tool_id' => 'id']);
    }
}
