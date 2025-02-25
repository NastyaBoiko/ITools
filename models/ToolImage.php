<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tool_image".
 *
 * @property int $id
 * @property string $created_at
 * @property int $tool_id
 * @property string $image
 *
 * @property Tool $tool
 */
class ToolImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tool_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['tool_id', 'image'], 'required'],
            [['tool_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['tool_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tool::class, 'targetAttribute' => ['tool_id' => 'id']],
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
            'image' => 'Image',
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
}
