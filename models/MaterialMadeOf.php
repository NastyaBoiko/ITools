<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material_made_of".
 *
 * @property int $id
 * @property string $title
 *
 * @property Tool[] $tools
 */
class MaterialMadeOf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material_made_of';
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
     * Gets query for [[Tools]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTools()
    {
        return $this->hasMany(Tool::class, ['material_made_of_id' => 'id']);
    }

    public static function getEntities()
    {
        return self::find()
                ->select('title')
                ->indexBy('id')
                ->column()
                ;
    }
}
