<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material_use_for".
 *
 * @property int $id
 * @property string $title
 *
 * @property ToolMaterialUseFor[] $toolMaterialUseFors
 */
class MaterialUseFor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material_use_for';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[ToolMaterialUseFors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToolMaterialUseFors()
    {
        return $this->hasMany(ToolMaterialUseFor::class, ['material_use_for_id' => 'id']);
    }
}
