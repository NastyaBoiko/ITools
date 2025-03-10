<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tool_status".
 *
 * @property int $id
 * @property string $title
 *
 * @property ToolHistory[] $toolHistories
 */
class ToolStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tool_status';
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
     * Gets query for [[ToolHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToolHistories()
    {
        return $this->hasMany(ToolHistory::class, ['tool_status_id' => 'id']);
    }

    public static function getEntityId(string $title): ?int
    {
        return self::findOne(['title' => $title])->id;
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
