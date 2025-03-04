<?php

use yii\bootstrap5\Html;

?>
                     
<div class="card custom-card">
    <?php if ($model->toolImages): ?>
        <div class="col-lg-12 col-md-12">
            <div id="carouselExampleControls<?= $model->id ?>" class="carousel slide pointer-event" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($model->toolImages as $key => $toolImage): ?>
                        <div class="carousel-item <?= $key === 0 ? "active" : ''?> ">
                            <?= Html::img('/uploads/' . $toolImage->image, [
                                'alt' => 'Фото инструмента',
                                'class' => 'd-block w-100',
                                'style' => 'height: 240px; width: 100%; object-fit: cover;' // Задаем высоту и ширину
                            ]) ?>
                        </div>
                    <?php endforeach ?>
                </div>

                <?php if (count($model->toolImages) > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?= $model->id ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?= $model->id ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>

    
    

    

    <div class="card custom-card border" style="background-color: #f8f9fa;">
        <div class="card-body p-2">
            <h6 class="card-title fw-bold text-primary" style="font-size: 1.2rem;">
                <i class="fas fa-tag me-2"></i><?= Html::encode($model->title) ?>
            </h6>
            <p class="card-text text-muted mb-1">
                <i class="fas fa-folder me-2"></i>Категория: <span class="text-secondary"><?= Html::encode($model->category->title) ?></span>
            </p>
            <p class="card-text fw-bold text-success mb-1">
                <i class="fas fa-barcode me-2"></i>Серийный номер: <span><?= Html::encode($model->serial_number) ?></span>
            </p>
            <?php if ($model->inventory_time): ?>
                <p class="card-text text-muted mb-2">
                    <i class="fas fa-calendar-alt me-2"></i>Инвентаризация: <span class="text-warning"><?= Html::encode($model->inventory_time) ?></span>
                </p>
            <?php endif ?>
            <div class="d-grid gap-2">
                <?= Html::a('<i class="fas fa-eye"></i> Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light my-1']) ?>
            </div>
        </div>
    </div>


</div>
