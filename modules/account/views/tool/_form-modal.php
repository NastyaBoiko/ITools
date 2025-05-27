<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Tool $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="tool-form">
    <?php Pjax::begin([
        'id' => 'form-return-pjax',
        'enablePushState' => false,
        'timeout' => 5000,
    ]) ?>

    <?php $form = ActiveForm::begin([
        'id' => 'return-modal-form',
        'options' => [
            'data-pjax' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'location_id')->dropdownList($locations, ['prompt' => 'Выберите местоположение']) ?>

    <?= $form->field($model, 'cell')->textInput(['maxlength' => true]) ?>

    <div class="form-group mb-0">
        <?= Html::submitButton('<i class="fa-solid fa-square-check"></i> Применить', ['class' => 'btn btn-outline-success rounded-pill btn-wave my-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php Pjax::end(); ?>

</div>