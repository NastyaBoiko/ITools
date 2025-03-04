<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tool $model */

$this->title = $model->id . '. ' . $model->toolMaker->title;
$this->params['breadcrumbs'][] = ['label' => 'Tools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
// dd($model->toolImages);
?>
<div class="tool-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Назад', ['index'], ['class' => 'btn btn-outline-info rounded-pill btn-wave waves-effect waves-light']) ?>
    </p>

    <?php DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'tool_maker_id',
            'category_id',
            'diameter',
            'full_length',
            'work_length',
            'material_made_of_id',
            'min_amount',
            'location_id',
            'cell',
            'project_id',
            'inventory_time',
            'delete_status',
            'qr',
        ],
    ]) ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body h-100">
                    <div class="row ">
                        <?php if ($model->toolImages): ?>
                            <div class=" col-xl-5 col-lg-12 col-md-12">
                                <div id="carouselExampleControls" class="carousel slide pointer-event" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($model->toolImages as $key => $toolImage): ?>
                                            <div class="carousel-item <?= $key === 0 ? "active" : ''?> ">
                                                <?= Html::img('/uploads/' . $toolImage->image, [
                                                    'alt' => 'Фото инструмента',
                                                    'class' => 'd-block w-100',
                                                    'style' => 'height: 300px; width: 100%; object-fit: cover;' // Задаем высоту и ширину
                                                ]) ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="details col-xl-7 col-lg-12 col-md-12 mt-3 mt-xl-0">
                            <h5 class="product-title mb-1"><?= Html::encode($model->toolMaker->title) ?></h5>
                            <p class="text-muted fs-14 mb-1"><i class="fas fa-folder"></i> <?= Html::encode($model->category->title) ?></p>
                            
                            <div class="product-info mt-2">
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-cogs"></i> 
                                    Из какого материала: <strong><span class="text-primary">
                                        <?= Html::encode($model->materialMadeOf->title) ?></span></strong>
                                </p>
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-ruler-combined"></i> 
                                    Диаметр: <strong><span class="text-primary">
                                        <?= Html::encode($model->diameter) . ' мм' ?></span></strong>
                                </p>
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-ruler"></i> 
                                    Общая длина: <strong><span class="text-primary">
                                        <?= Html::encode($model->full_length) . ' мм' ?></span></strong>
                                </p>
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-ruler-horizontal"></i> 
                                    Рабочая длина: <strong><span class="text-primary">
                                        <?= Html::encode($model->work_length) . ' мм' ?></span></strong>
                                </p>
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-map-marker-alt"></i> 
                                    Местоположение: <strong><span class="text-success">
                                        <?= Html::encode($model->location->title) ?></span></strong>
                                </p>
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-th"></i> 
                                    Ячейка: <strong><span class="text-danger">
                                        <?= Html::encode($model->cell == '' ? 'Не указана' : $model->cell) ?></span></strong>
                                </p>
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-folder-open"></i> 
                                    Проект: <strong><span class="text-warning">
                                        <?= Html::encode($model->project?->title ?? 'Без проекта') ?></span></strong>
                                </p>
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-sort-numeric-up"></i> 
                                    Минимально необходимое количество: <strong><span class="text-danger">
                                        <?= Html::encode($model->min_amount) ?></span></strong>
                                </p>
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-calendar-alt"></i> 
                                    Дата и время инвентаризации: <strong><span class="text-danger">
                                        <?= Html::encode($model->inventory_time == '' ? 'Не указана' : $model->inventory_time) ?></span></strong>
                                </p>
                            </div>

                            <div class="action mt-3">
                                <?= Html::a('<i class="fas fa-edit"></i> Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light']) ?>
                                <?= Html::a('<i class="fas fa-trash-alt"></i> Удалить', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-outline-danger rounded-pill btn-wave waves-effect waves-light',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
