<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tool $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tool-form col-8">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropdownList($categories, ['prompt' => 'Выберите категорию']) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'min_amount')->textInput() ?>

    <?= $form->field($model, 'location_id')->dropdownList($locations, ['prompt' => 'Выберите местоположение']) ?>

    <?= $form->field($model, 'cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_id')->dropdownList($projects, ['prompt' => 'Выберите проект']) ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-outline-success rounded-pill btn-wave my-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
