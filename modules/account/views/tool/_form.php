<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tool $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="tool-form col-8">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'location_id')->dropdownList($locations, ['prompt' => 'Выберите местоположение']) ?>

    <?= $form->field($model, 'cell')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Вернуть на склад', ['class' => 'btn btn-outline-success rounded-pill btn-wave my-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
