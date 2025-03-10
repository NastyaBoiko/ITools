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
                'action' => ['index'],
                'method' => 'get',
            ]); ?>

            <?= $form->field($model, 'id') ?>

            <?= $form->field($model, 'created_at') ?>

            <?= $form->field($model, 'updated_at') ?>

            <?= $form->field($model, 'tool_maker_id')->dropDownList(ToolMaker::getEntities(), [
                    'prompt' => 'Выберите производителя',
                ]) ?>

            <?= $form->field($model, 'category_id')->dropDownList(Category::getEntities(), [
                    'prompt' => 'Выберите категорию',
                ]) ?>

            <?= $form->field($model, 'status_id')->dropDownList($statuses, [
                    'prompt' => 'Выберите статус',
                ]) ?>

            <?= $form->field($model, 'user_id')->dropDownList($users, [
                    'prompt' => 'Выберите ответственного',
                ]) ?>

            <?= $form->field($model, 'diameter_start') ?>
            <?= $form->field($model, 'diameter_end') ?>

            <?php // echo $form->field($model, 'full_length') ?>

            <?php // echo $form->field($model, 'work_length') ?>

            <?php // echo $form->field($model, 'material_made_of_id') ?>

            <?php // echo $form->field($model, 'min_amount') ?>

            <?php // echo $form->field($model, 'location_id') ?>

            <?php // echo $form->field($model, 'cell') ?>

            <?php // echo $form->field($model, 'project_id') ?>

            <?php // echo $form->field($model, 'inventory_time') ?>

            <?php // echo $form->field($model, 'delete_status') ?>

            <?php // echo $form->field($model, 'qr') ?>

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
