<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="col-xl-3 col-lg-4 col-md-12 mb-3 mb-md-0">
    <div class="card p-3 mb-3">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>

        <?= $form->field($model, 'id') ?>

        <?= $form->field($model, 'created_at') ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'surname') ?>

        <?= $form->field($model, 'patronymic') ?>

        <?php // echo $form->field($model, 'email') ?>

        <?php // echo $form->field($model, 'password') ?>

        <?php // echo $form->field($model, 'phone') ?>

        <?php // echo $form->field($model, 'role_id') ?>

        <?php // echo $form->field($model, 'auth_key') ?>

        <div class="form-group d-flex flex-column gap-2">
            <?= Html::submitButton('Поиск', ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light']) ?>
            <?= Html::a('Сбросить', ['index'], ['class' => 'btn btn-outline-secondary rounded-pill btn-wave waves-effect waves-light']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

