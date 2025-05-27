<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;

/** @var yii\web\View $this */
/** @var app\models\Tool $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="tool-form col-8">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tool_maker_id')->dropdownList($toolMakers + [-1 => 'Добавить...'], ['prompt' => 'Выберите производителя']) ?>

    <?= $form->field($model, 'new_tool_maker', [
        'options' => ['style' => 'display: none;']
    ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diameter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'material_made_of_id')->dropdownList($materialsMadeOf, ['prompt' => 'Выберите материал из чего']) ?>

    <?php if (isset($materialsUseForCurrent)): ?>
        <?= $form->field($model, 'materialsUseFor')->checkboxList($materialsUseFor, ['value' => $materialsUseForCurrent]) ?>
    <?php else: ?>
        <?= $form->field($model, 'materialsUseFor')->checkboxList($materialsUseFor) ?>
    <?php endif ?>

    <?= $form->field($model, 'category_id')->dropdownList($categories, ['prompt' => 'Выберите категорию']) ?>

    <?php $form->field($model, 'min_amount')->textInput() ?>

    <?= $form->field($model, 'location_id')->dropdownList($locations, ['prompt' => 'Выберите местоположение']) ?>

    <?= $form->field($model, 'cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_id')->dropdownList($projects, ['prompt' => 'Выберите проект']) ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?php if ($model->id): ?>
        <div class="mb-2">Загруженные файлы:</div>
        <?php if (!empty($model->toolImages)): ?>
            <div class="d-flex gap-2 flex-wrap">
                <?php foreach ($model->toolImages as $toolImageModel): ?>
                    <div style="position: relative; display: inline-block;">
                        <!-- Миниатюра изображения -->
                        <img src="<?= Yii::getAlias('@web') . '/' . $model::IMG_PATH . Html::encode($toolImageModel->image) ?>"
                            alt="Текущее изображение"
                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 10%; border: 2px solid #ccc;">

                        <!-- Крестик для удаления -->
                        <?= Html::a(
                            '<i class="fa-solid fa-circle-xmark"></i>',
                            ['delete-tool-image', 'id' => $model->id, 'filename' => $toolImageModel->image], // Ссылка на действие для удаления изображения 
                            [
                                'class' => 'delete-image',
                                'style' => 'position: absolute; top: 5px; right: 5px; color: #fff; background-color: #ff4d4d; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; text-decoration: none;',
                                'title' => 'Удалить изображение',
                                'data-confirm' => 'Вы уверены, что хотите удалить это изображение?', // Подтверждение перед удалением
                                'data-method' => 'post', // Метод отправки запроса
                            ]
                        ) ?>
                    </div>
                <?php endforeach ?>
            </div>
        <?php else: ?>
            <p>Файлы не загружены.</p>
        <?php endif; ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton(($model->id ? '<i class="fas fa-edit"></i> Изменить' : '<i class="fas fa-plus"></i> Создать'), ['class' => 'btn btn-outline-success rounded-pill btn-wave my-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJsFile('/js/tool.js', ['depends' => JqueryAsset::class]);
?>