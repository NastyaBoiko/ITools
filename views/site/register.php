<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
?>
<h2 class="my-3">Регистрация нового пользователя</h2>

<div class="site-register col-8">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'surname') ?>
        <?= $form->field($model, 'patronymic') ?>
        <?= $form->field($model, 'email', ['enableAjaxValidation' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        <?= $form->field($model, 'phone', ['enableAjaxValidation' => true])->widget(MaskedInput::class, [
            'mask' => '+7-999-999-99-99'
        ]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Зарегистрировать', ['class' => 'btn btn-outline-primary rounded-pill btn-wave']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->
