<?php

namespace app\modules\common\models;

use app\models\User;
use app\models\UserExtras;
use Yii;
use yii\base\Model;

/**
 * This is the model class for change passsword form.
 *
 * @property string $old_password
 * @property string $password
 * @property string $password_repeat
 *
 */
class ChangePasswordForm extends Model
{
    public $old_password;
    public $password;
    public $password_repeat;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['old_password', 'password', 'password_repeat'], 'required'],
            [['old_password', 'password', 'password_repeat'], 'string', 'min' => 6],
            [['old_password', 'password', 'password_repeat'], 'string', 'max' => 255],

            [['old_password'], 'validateOldPassword'],

            [['password', 'password_repeat', 'old_password'], 'match', 'pattern' => '/^[а-яёa-z\d]+$/ui', 'message' => 'Разрешенные символы: кириллица, латиница, цифры'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Поля \'Новый пароль\' и \'Повтор нового пароля\' должны совпадать'],
        ];
    }

    public function validateOldPassword($attribute, $params)
    {
        if (!Yii::$app->security->validatePassword($this->old_password, Yii::$app->user->identity->password)) {
            $this->addError($attribute, 'Пароль не совпадает с текущим');
        }
    }

    public function attributeLabels()
    {
        return [
            'old_password' => 'Текущий пароль',
            'password' => 'Новый пароль',
            'password_repeat' => 'Повтор нового пароля',
        ];
    }

    public function updatePassword()
    {
        if ($this->validate()) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $user->password = Yii::$app->security->generatePasswordHash($this->password);

            if ($user->save()) {
                return true;
            }

            return false;
        }
    }
}
