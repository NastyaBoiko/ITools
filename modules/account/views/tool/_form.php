<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tool $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="tool-form col-8">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tool_maker_id')->dropdownList($toolMakers, ['prompt' => 'Выберите производителя']) ?>

    <?= $form->field($model, 'diameter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'material_made_of_id')->dropdownList($materialsMadeOf, ['prompt' => 'Выберите материал из чего']) ?>

    <?php if (isset($materialsUseForCurrent)): ?>
        <?= $form->field($model, 'materialsUseFor')->checkboxList($materialsUseFor, ['value' => $materialsUseForCurrent])?>
    <?php else: ?>
        <?= $form->field($model, 'materialsUseFor')->checkboxList($materialsUseFor)?>
    <?php endif ?>
    <?= $form->field($model, 'category_id')->dropdownList($categories, ['prompt' => 'Выберите категорию']) ?>

    <?= $form->field($model, 'min_amount')->textInput() ?>

    <?= $form->field($model, 'location_id')->dropdownList($locations, ['prompt' => 'Выберите местоположение']) ?>

    <?= $form->field($model, 'cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_id')->dropdownList($projects, ['prompt' => 'Выберите проект']) ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton(($model->id ? 'Изменить' : 'Создать'), ['class' => 'btn btn-outline-success rounded-pill btn-wave my-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
