<?php

use app\models\Role;
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

        <?= $form->field($model, 'id')->label('Внутренний номер') ?>

        <?= $form->field($model, 'role_id')->dropDownList(Role::getTranslatedEntities(), ['prompt' => 'Выберите роль']) ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'surname') ?>

        <?= $form->field($model, 'register_start')->textInput(['type' => 'date', 'max' => date('Y-m-d', strtotime('-1 day'))]) ?>
        <?= $form->field($model, 'register_end')->textInput(['type' => 'date', 'max' => date('Y-m-d')]) ?>


        <?php // $form->field($model, 'patronymic') 
        ?>

        <?php // echo $form->field($model, 'email') 
        ?>

        <?php // echo $form->field($model, 'password') 
        ?>

        <?php // echo $form->field($model, 'phone') 
        ?>


        <?php // echo $form->field($model, 'auth_key') 
        ?>

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