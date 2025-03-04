<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tool_maker".
 *
 * @property int $id
 * @property string $title
 *
 * @property Tool[] $tools
 */
class ToolMaker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tool_maker';
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
        return $this->hasMany(Tool::class, ['tool_maker_id' => 'id']);
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
