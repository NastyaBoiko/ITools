<?php

use app\models\Category;
use app\models\ToolMaker;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Tool2Search $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="col-xl-3 col-lg-4 col-md-12 mb-3 mb-md-0">
    <div class="card p-3 mb-3">

        <?php $form = ActiveForm::begin([
            'id' => 'tool-search-form',
            'action' => ['my-tools'],
            'method' => 'get',
        ]); ?>

        <?= $form->field($model, 'id') ?>

        <?= $form->field($model, 'tool_maker_id')->dropDownList(ToolMaker::getEntities(), [
            'prompt' => 'Выберите производителя',
        ]) ?>

        <?= $form->field($model, 'category_id')->dropDownList(Category::getEntities(), [
            'prompt' => 'Выберите категорию',
        ]) ?>

        <?= $form->field($model, 'status_id')->dropDownList($statuses, [
            'prompt' => 'Выберите статус',
        ]) ?>

        <?= $form->field($model, 'location_id')->dropDownList($locations, [
            'prompt' => 'Выберите местоположение',
        ]) ?>

        <?= $form->field($model, 'material_made_of_id')->dropDownList($materialsMadeOf, [
            'prompt' => 'Из какого материала',
        ]) ?>

        <?= $form->field($model, 'user_id')->dropDownList($users, [
            'prompt' => 'Выберите ответственного',
        ]) ?>

        Диаметр
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="flex-grow-1">
                <?= $form->field($model, 'diameter_start', [
                    'options' => ['class' => 'mb-0'], // Убираем отступы под полем
                    'inputOptions' => ['placeholder' => 'От'],
                ])->textInput([
                    'class' => 'form-control form-control-lg', // Увеличиваем размер поля
                ])->label(false) ?>
            </div>

            <span class="text-muted">—</span> <!-- Разделитель -->

            <div class="flex-grow-1">
                <?= $form->field($model, 'diameter_end', [
                    'options' => ['class' => 'mb-0'], // Убираем отступы под полем
                    'inputOptions' => ['placeholder' => 'До'],
                ])->textInput([
                    'class' => 'form-control form-control-lg', // Увеличиваем размер поля
                ])->label(false) ?>
            </div>
        </div>

        Общая длина
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="flex-grow-1">
                <?= $form->field($model, 'full_length_start', [
                    'options' => ['class' => 'mb-0'], // Убираем отступы под полем
                    'inputOptions' => ['placeholder' => 'От'],
                ])->textInput([
                    'class' => 'form-control form-control-lg', // Увеличиваем размер поля
                ])->label(false) ?>
            </div>

            <span class="text-muted">—</span> <!-- Разделитель -->

            <div class="flex-grow-1">
                <?= $form->field($model, 'full_length_end', [
                    'options' => ['class' => 'mb-0'], // Убираем отступы под полем
                    'inputOptions' => ['placeholder' => 'До'],
                ])->textInput([
                    'class' => 'form-control form-control-lg', // Увеличиваем размер поля
                ])->label(false) ?>
            </div>
        </div>

        Рабочая длина
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="flex-grow-1">
                <?= $form->field($model, 'work_length_start', [
                    'options' => ['class' => 'mb-0'], // Убираем отступы под полем
                    'inputOptions' => ['placeholder' => 'От'],
                ])->textInput([
                    'class' => 'form-control form-control-lg', // Увеличиваем размер поля
                ])->label(false) ?>
            </div>

            <span class="text-muted">—</span> <!-- Разделитель -->

            <div class="flex-grow-1">
                <?= $form->field($model, 'work_length_end', [
                    'options' => ['class' => 'mb-0'], // Убираем отступы под полем
                    'inputOptions' => ['placeholder' => 'До'],
                ])->textInput([
                    'class' => 'form-control form-control-lg', // Увеличиваем размер поля
                ])->label(false) ?>
            </div>
        </div>

        <?php // echo $form->field($model, 'full_length') 
        ?>

        <?php // echo $form->field($model, 'work_length') 
        ?>

        <?php // echo $form->field($model, 'material_made_of_id') 
        ?>

        <?php // echo $form->field($model, 'min_amount') 
        ?>

        <?php // echo $form->field($model, 'location_id') 
        ?>

        <?php // echo $form->field($model, 'cell') 
        ?>

        <?php // echo $form->field($model, 'project_id') 
        ?>

        <?php // echo $form->field($model, 'inventory_time') 
        ?>

        <?php // echo $form->field($model, 'delete_status') 
        ?>

        <?php // echo $form->field($model, 'qr') 
        ?>

        <div class="form-group d-flex flex-column gap-2">
            <?= Html::a('<i class="fas fa-undo"></i> Сбросить', ['my-tools'], [
                'class' => 'btn btn-outline-secondary rounded-pill btn-wave waves-effect waves-light',
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>