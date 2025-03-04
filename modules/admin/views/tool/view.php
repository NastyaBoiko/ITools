<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tool $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
// dd($model->toolImages);
?>
<div class="tool-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-outline-info rounded-pill btn-wave waves-effect waves-light']) ?>

    </p>

    <?php DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'title',
            'category_id',
            'amount',
            'min_amount',
            'serial_number',
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
                        <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                            <h5 class="product-title mb-1"><?= Html::encode($model->title) ?></h5>
                            <p class="text-muted fs-13 mb-1"><?= Html::encode($model->category->title) ?></p>
                            <p class="product-description mt-3 mb-1"><strong>Серийный номер:</strong> <?= Html::encode($model->serial_number) ?></p>
                            <p class="product-description mt-3 mb-1"><strong>Местоположение:</strong> <?= Html::encode($model->location->title) ?></p>
                            <p class="product-description mt-3 mb-1"><strong>Проект:</strong> <?= Html::encode($model->project?->title ?? 'Без проекта') ?></p>
                            <p class="product-description mt-3 mb-1"><strong>Ячейка:</strong> <?= Html::encode($model->cell == '' ? 'Не указана' : $model->cell ) ?></p>

                            <!-- <div class="action mt-4">
                                <a href="wish-list.html" class="add-to-cart btn btn-danger my-1 me-1">ADD TO
                                WISHLIST</a>
                                <a href="product-cart.html" class="add-to-cart btn btn-success">ADD TO
                                CART</a>
                            </div> -->

                            <div class="action mt-4">
                                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light']) ?>
                                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-outline-danger rounded-pill btn-wave waves-effect waves-light',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
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
