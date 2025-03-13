<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $title
 * @property int $delete_status
 * @property string $created_at
 *
 * @property Tool[] $tools
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['delete_status'], 'integer'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'title' => 'Название',
            'delete_status' => 'Delete Status',
            'created_at' => 'Дата и время создания',
        ];
    }

    /**
     * Gets query for [[Tools]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTools()
    {
        return $this->hasMany(Tool::class, ['location_id' => 'id']);
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
