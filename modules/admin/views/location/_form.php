<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Category $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(($model->id ? 'Изменить' : 'Создать'), ['class' => 'btn btn-outline-success rounded-pill btn-wave my-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
