<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Location $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="location-form">

    <?php $form = ActiveForm::begin([
        'id' => 'update-location-modal-form',
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group d-flex justify-content-between">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Назад', ['index'], ['class' => 'btn btn-outline-info rounded-pill btn-wave waves-effect waves-light mt-3 close-location-modal-update']) ?>
        <?= Html::submitButton(('<i class="fas fa-edit"></i> Изменить'), ['class' => 'btn btn-outline-success rounded-pill btn-wave mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>