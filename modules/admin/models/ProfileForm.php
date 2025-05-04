<?php

namespace app\modules\admin\models;

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
 * @property string $old_password
 * @property string $password
 * @property string $password_repeat
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
    public $old_password;
    public $password;
    public $password_repeat;
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
            [['name', 'surname', 'patronymic', 'email', 'password', 'password_repeat', 'phone', 'status', 'position', 'telegram', 'vk'], 'string', 'max' => 255],
            [['about'], 'string'],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яё\-]+$/ui', 'message' => 'Разрешенные символы: кириллица и тире'],

            ['email', 'email'],

            [['old_password'], 'string', 'min' => 6],
            [['password', 'password_repeat', 'old_password'], 'validateOldPassword'],

            [['password'], 'string', 'min' => 6],
            [['password_repeat'], 'string', 'min' => 6],
            [['password', 'password_repeat', 'old_password'], 'match', 'pattern' => '/^[а-яёa-z\d]+$/ui', 'message' => 'Разрешенные символы: кириллица, латиница, цифры'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Поля \'Новый пароль\' и \'Повтор нового пароля\' должны совпадать'],

            // Условное требование заполнения password_repeat
            [
                'password_repeat',
                'required',
                'when' => fn($model) => !empty($model->password),
                'whenClient' => "() => $('#profileform-password').val() !== ''",
                'message' => 'Необходимо повторить новый пароль'
            ],

            [['phone'], 'match', 'pattern' => '/^\+7\-[\d]{3}\-[\d]{3}\-[\d]{2}\-[\d]{2}$/', 'message' => 'Формат +7-XXX-XXX-XX-XX'],

            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function validateOldPassword($attribute, $params)
    {
        if ($this->old_password == '') {
            $this->addError($attribute, 'Необходимо заполнить текущий пароль');
        } elseif (!Yii::$app->security->validatePassword($this->old_password, Yii::$app->user->identity->password)) {
            $this->addError($attribute, 'Некорректный текущий пароль');
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'Почта',
            'old_password' => 'Текущий пароль',
            'password' => 'Новый пароль',
            'password_repeat' => 'Повтор нового пароля',
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

    public function saveAll()
    {
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $userExtras = UserExtras::findOne(['user_id' => Yii::$app->user->id]);

        $user->load($this->attributes, '');
        $userExtras->load($this->attributes, '');

        if (is_null($userExtras->avatar)) {
            $userExtras->avatar = Yii::$app->user->identity->userExtras->avatar;
        }

        if ($this->password) {
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
        } else {
            $user->password = Yii::$app->user->identity->password;
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
