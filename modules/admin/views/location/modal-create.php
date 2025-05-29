<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Category $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['action' => ['create']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group d-flex justify-content-between">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Назад', ['index'], ['class' => 'btn btn-outline-info rounded-pill btn-wave waves-effect waves-light mt-3 close-location-modal']) ?>
        <?= Html::submitButton(('<i class="fas fa-plus"></i> Создать'), ['class' => 'btn btn-outline-success rounded-pill btn-wave mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>