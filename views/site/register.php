<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

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
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'phone') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Зарегистрировать', ['class' => 'btn btn-outline-primary rounded-pill btn-wave']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->
