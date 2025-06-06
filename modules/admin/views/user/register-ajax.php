<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
?>

<div class="site-register">

    <?php $form = ActiveForm::begin([
        'id' => 'form-register-ajax'
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['placeholder' => 'Введите имя']) ?>
    <?= $form->field($model, 'surname')->textInput(['placeholder' => 'Введите фамилию']) ?>
    <?= $form->field($model, 'patronymic')->textInput(['placeholder' => 'Введите отчество']) ?>
    <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['placeholder' => 'Введите адрес электронной почты']) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Введите пароль']) ?>
    <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'Введите повтор пароля']) ?>
    <?= $form->field($model, 'phone', ['enableAjaxValidation' => true])->widget(MaskedInput::class, [
        'mask' => '+7-999-999-99-99'
    ])->textInput(['placeholder' => 'Введите номер телефона']) ?>

    <div class="form-group d-flex justify-content-end mb-0 mt-4">
        <?= Html::submitButton(
            '<i class="fa-solid fa-address-card"></i> Зарегистрировать',
            ['class' => 'btn btn-outline-primary rounded-pill btn-wave btn-register-ajax']
        ) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>