<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string $title
 *
 * @property User[] $users
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
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
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['role_id' => 'id']);
    }

    public static function getEntityId(string $title): ?int
    {
        return self::findOne(['title' => $title])->id;
    }

    public static function getRoleTranslate(string $title): ?string
    {
        $roles = [
            'admin' => 'Администратор',
            'user' => 'Пользователь',
        ];

        return $roles[$title];
    }

    public static function getTranslatedEntities()
    {
        $roles = self::find()
        ->select('title')
        ->indexBy('id')
        ->column()
        ;

        return array_map(fn($role) => self::getRoleTranslate($role), $roles);
    }
}
