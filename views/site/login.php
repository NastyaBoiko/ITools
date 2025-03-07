<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\JqueryAsset;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

<h3>Добро пожаловать!</h3>
<h6 class="fw-medium mb-4 fs-17">Войдите, чтобы продолжить</h6>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'fieldConfig' => [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
        'inputOptions' => ['class' => 'col-lg-3 form-control'],
        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
    ],
]); ?>

<?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Введите почту или телефон']) ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Введите пароль']) ?>

<?= $form->field($model, 'rememberMe')->checkbox([
    'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
]) ?>

<div class="form-group">
    <div>
        <?= Html::submitButton('Войти', ['class' => 'btn btn-outline-primary rounded-pill btn-wave btn-block w-100', 'name' => 'login-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<div style="color:#999;">
    <div class="">Администратор <strong>adminka@mail.ru/Password123</strong></div>
    <div class="">Пользователь <strong>user@mail.ru/123456</strong></div>
</div>


<?php

$this->registerJsFile('/js/login.js', ['depends' => JqueryAsset::class]);

?>

