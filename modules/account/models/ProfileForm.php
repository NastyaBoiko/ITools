<?php

namespace app\modules\account\models;

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

            [['phone'], 'match', 'pattern' => '/^\+7\-[\d]{3}\-[\d]{3}\-[\d]{2}\-[\d]{2}$/', 'message' => 'Формат +7-XXX-XXX-XX-XX'],
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
        ];
    }

    public function saveAll()
    {
        if ($this->validate()) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $userExtras = UserExtras::findOne(['user_id' => Yii::$app->user->id]);

            $user->load($this->attributes, '');
            $userExtras->load($this->attributes, '');

            if ($this->password) {
                $user->password = Yii::$app->security->generatePasswordHash($this->password);
            } else {
                $user->password = Yii::$app->user->identity->password;
            }

            if ($user->save()) {
                if ($userExtras->save()) {
                    return true;
                } else {
                    dd($userExtras->errors);
                }
            } else {
                dd($user->errors);
            }
        }

        return false;


        // dump($user);
        // dd($userExtras);
        // if ($this->validate()) {
        // }
    }
}
