<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\CategorySearch $model */
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

        <?= $form->field($model, 'title') ?>

        <?= $form->field($model, 'created_at') ?>

        <div class="form-group d-flex flex-column gap-2">
            <?= Html::submitButton('<i class="fas fa-search"></i> Поиск', [
                'class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light',
            ]) ?>
            <?= Html::a('<i class="fas fa-undo"></i> Сбросить', ['index'], [
                'class' => 'btn btn-outline-secondary rounded-pill btn-wave waves-effect waves-light',
            ]) ?>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>
