<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $created_at
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property int $role_id
 * @property string $auth_key
 *
 * @property Order[] $orders
 * @property Role $role
 * @property ToolComment[] $toolComments
 * @property ToolHistory[] $toolHistories
 */
class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_REGISTER = 'register';
    public $password_repeat = '';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'auth_key'], 'safe'],
            [['name', 'surname', 'email', 'password', 'phone'], 'required'],
            [['password_repeat'], 'required', 'on' => self::SCENARIO_REGISTER],
            [['name', 'surname', 'patronymic', 'email', 'password', 'password_repeat', 'phone'], 'string', 'max' => 255],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яё\-]+$/ui', 'message' => 'Разрешенные символы: кириллица и тире'],

            ['email', 'email'],
            [['email'], 'unique', 'message' => 'Пользователь с такой почтой уже существует'],

            [['password'], 'string', 'min' => 6],
            [['password_repeat'], 'string', 'min' => 6],
            [['password', 'password_repeat'], 'match', 'pattern' => '/^[а-яёa-z\d]+$/ui', 'message' => 'Разрешенные символы: кириллица, латиница, цифры', 'on' => self::SCENARIO_REGISTER],
            // [['password', 'password_repeat'], 'match', 'pattern' => '/^[а-яёa-z\d]+$/ui', 'message' => 'Разрешенные символы: кириллица, латиница, цифры'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Поля \'Пароль\' и \'Повтор пароля\' должны совпадать'],

            [['phone'], 'unique', 'message' => 'Пользователь с таким номером телефона уже существует'],
            [['phone'], 'match', 'pattern' => '/^\+7\-[\d]{3}\-[\d]{3}\-[\d]{2}\-[\d]{2}$/', 'message' => 'Формат +7-XXX-XXX-XX-XX'],

            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'created_at' => 'Дата регистрации',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'Почта',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'phone' => 'Телефон',
            'role_id' => 'Роль',
            'auth_key' => 'Код аутентификации',
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * Gets query for [[ToolComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToolComments()
    {
        return $this->hasMany(ToolComment::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[ToolHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToolHistories()
    {
        return $this->hasMany(ToolHistory::class, ['user_id' => 'id']);
    }

    public function getIsAdmin()
    {
        return $this->role_id === Role::getEntityId('admin');
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            
            $user->attributes = $this->attributes;
            $user->role_id = Role::getEntityId('user');
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            
            if (!$user->save(false)) {
                dd($user->errors);
            }
        }
        return $user ?? false;
    }

    public static function findByEmailOrPhone(string $emailOrPhone)
    {
        return self::findOne(['email' => $emailOrPhone]) ?? self::findOne(['phone' => $emailOrPhone]);
    }

    public function validatePassword(string $password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
