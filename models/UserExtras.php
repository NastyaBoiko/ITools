<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_extras".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $status
 * @property string|null $position
 * @property string|null $about
 * @property string|null $telegram
 * @property string|null $vk
 *
 * @property User $user
 */
class UserExtras extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_extras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'position', 'about', 'telegram', 'vk'], 'default', 'value' => null],
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['about'], 'string'],
            [['status', 'position', 'telegram', 'vk'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'position' => 'Должность',
            'about' => 'Биография',
            'telegram' => 'Ссылка на Telegram',
            'vk' => 'Ссылка на Вконтакте',
        ];
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
