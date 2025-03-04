<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tool_material_use_for".
 *
 * @property int $id
 * @property int $tool_id
 * @property int $material_use_for_id
 * @property int $delete_status
 *
 * @property MaterialUseFor $materialUseFor
 * @property Tool $tool
 */
class ToolMaterialUseFor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tool_material_use_for';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tool_id', 'material_use_for_id'], 'required'],
            [['tool_id', 'material_use_for_id', 'delete_status'], 'integer'],
            [['material_use_for_id'], 'exist', 'skipOnError' => true, 'targetClass' => MaterialUseFor::class, 'targetAttribute' => ['material_use_for_id' => 'id']],
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
            'tool_id' => 'Tool ID',
            'material_use_for_id' => 'Material Use For ID',
            'delete_status' => 'Delete Status',
        ];
    }

    /**
     * Gets query for [[MaterialUseFor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialUseFor()
    {
        return $this->hasOne(MaterialUseFor::class, ['id' => 'material_use_for_id']);
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
