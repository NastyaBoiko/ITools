<?php

namespace app\modules\common\models;

use app\models\User;
use app\models\UserExtras;
use Yii;
use yii\base\Model;

/**
 * This is the model class for profile form.
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $email
 * @property string $phone
 * @property string $about
 *
 */
class ProfileForm extends Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $email;
    public $phone;
    public $about;
    public $status;
    public $position;
    public $vk;
    public $telegram;
    public $avatar;
    public $imageFile;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'phone'], 'required'],
            [['name', 'surname', 'patronymic', 'email', 'phone', 'status', 'position', 'telegram', 'vk'], 'string', 'max' => 255],
            [['about'], 'string'],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яё\-]+$/ui', 'message' => 'Разрешенные символы: кириллица и тире'],

            ['email', 'email'],

            [['phone'], 'match', 'pattern' => '/^\+7\-[\d]{3}\-[\d]{3}\-[\d]{2}\-[\d]{2}$/', 'message' => 'Формат +7-XXX-XXX-XX-XX'],

            [['phone'], 'validateUniquePhone'],
            [['email'], 'validateUniqueEmail'],

            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function validateUniquePhone($attribute, $params)
    {
        $user = User::findOne(['phone' => $this->phone]);

        if (!is_null($user) && ($user->id !== Yii::$app->user->id)) {
            $this->addError($attribute, 'Номер телефона уже используется');
        }
    }

    public function validateUniqueEmail($attribute, $params)
    {
        $user = User::findOne(['email' => $this->email]);

        if (!is_null($user) && ($user->id !== Yii::$app->user->id)) {
            $this->addError($attribute, 'Почта уже используется');
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'Почта',
            'phone' => 'Телефон',
            'status' => 'Статус',
            'about' => 'Биография',
            'position' => 'Должность',
            'telegram' => 'Ссылка на Telegram',
            'vk' => 'Ссылка на Вконтакте',
            'imageFile' => 'Аватар',
            'avatar' => 'Аватар',
        ];
    }

    public function saveAll(bool $needValidation)
    {
        if ($needValidation) {
            $this->validate();
        }

        $user = User::findOne(['id' => Yii::$app->user->id]);
        $userExtras = UserExtras::findOne(['user_id' => Yii::$app->user->id]);

        $user->load($this->attributes, '');
        $userExtras->load($this->attributes, '');

        if (is_null($userExtras->avatar)) {
            $userExtras->avatar = Yii::$app->user->identity->userExtras->avatar;
        }

        if ($user->save()) {
            if ($userExtras->save()) {
                return true;
            }
            // else {
            //     dd($userExtras->errors);
            // }
        }
        // else {
        //     dd($user->errors);
        // }

        return false;
    }

    public function upload()
    {
        if ($this->validate()) {
            // Путь к директории аватаров
            $directory = 'avatars/';

            // Удаление всех предыдущих аватаров пользователя
            $userId = Yii::$app->user->id;
            $files = glob($directory . $userId . '_*'); // Находим все файлы, начинающиеся с ID пользователя

            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); // Удаляем файл
                }
            }

            $fileName = Yii::$app->user->id . '_' . date('U') . '_' . Yii::$app->security->generateRandomString(10) . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs('avatars/' . $fileName);
            $this->avatar = $fileName;
            return true;
        } else {
            return false;
        }
    }
}
