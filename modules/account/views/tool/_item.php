<?php

use yii\bootstrap5\Html;
// dd(end($model->toolHistories)->toolStatus->title);
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
            <div class="product-info mx-2">
                <h5 class="product-title mb-1"><?= Html::encode($model->id . '. ' . $model->toolMaker->title) ?></h5>
                <p class="text-muted fs-14 mb-1"><i class="fas fa-folder"></i> <?= Html::encode($model->category->title) ?></p>
            </div>
            
            <div class="product-info mt-2">
                <?php if ($model->toolHistories): ?>
                    <p class="product-description mb-1 bg-light p-2 rounded">
                        <i class="fas fa-info-circle"></i> 
                        Статус: <strong><span class="">
                            <?= Html::encode($status = end($model->toolHistories)->toolStatus->title) ?></span></strong>
                    </p>
                    <p class="product-description mb-1 bg-light p-2 rounded">
                        <i class="fas fa-user"></i> 
                        Ответственный: <strong><span class="">
                            <?= Html::encode(end($model->toolHistories)->user->surname) ?></span></strong>
                    </p>
                <?php endif; ?>
                <p class="product-description mb-1 bg-light p-2 rounded">
                    <i class="fas fa-box"></i> 
                    Из какого материала: <strong><span class="">
                        <?= Html::encode($model->materialMadeOf->title) ?></span></strong>
                </p>
                <?php if ($model->materialsUseFors): ?>
                    <p class="product-description mb-1 bg-light p-2 rounded">
                        <i class="fas fa-tools"></i> 
                        Для какого материала: <strong>
                            <?php foreach ($model->materialsUseFors as $key => $materialUseFor): ?>
                                <span class="">
                                    <?= Html::encode((($key !== 0) ? ', ' : '') . $materialUseFor->title) ?>
                                </span>
                            <?php endforeach; ?>
                        </strong>
                    </p>
                <?php endif; ?>

                <p class="product-description mb-1 bg-light p-2 rounded">
                    <i class="fas fa-ruler-combined"></i> 
                    Диаметр: <strong><span class="">
                        <?= Html::encode($model->diameter) . ' мм' ?></span></strong>
                </p>
                <p class="product-description mb-1 bg-light p-2 rounded">
                    <i class="fas fa-ruler-horizontal"></i> 
                    Рабочая длина: <strong><span class="">
                        <?= Html::encode($model->work_length) . ' мм' ?></span></strong>
                </p>
                <p class="product-description mb-1 bg-light p-2 rounded">
                    <i class="fas fa-map-marker-alt"></i> 
                    Местоположение: <strong><span class="">
                        <?= Html::encode($model->location->title) ?></span></strong>
                </p>
                <p class="product-description mb-1 bg-light p-2 rounded">
                    <i class="fas fa-th"></i> 
                    Ячейка: <strong><span class="">
                        <?= Html::encode($model->cell == '' ? 'Не указана' : $model->cell) ?></span></strong>
                </p>
                <p class="product-description mb-1 bg-light p-2 rounded">
                    <i class="fas fa-folder-open"></i> 
                    Проект: <strong><span class="">
                        <?= Html::encode($model->project?->title ?? 'Без проекта') ?></span></strong>
                </p>
                <?php if ($model->inventory_time): ?>
                    <p class="product-description mb-1 bg-light p-2 rounded">
                        <i class="fas fa-calendar-alt me-2"></i>Инвентаризация: <span class=""><?= Html::encode($model->inventory_time) ?></span>
                    </p>
                <?php endif; ?>
            </div>
            <div class="d-grid gap-1">
                <?= Html::a('<i class="fas fa-eye"></i> Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light my-1']) ?>
                <?= $status === 'Доступен' 
                    ?  Html::a('<i class="fas fa-check"></i> Взять в работу', [
                        'work', 
                        'id' => $model->id, 
                        'page' => Yii::$app->request->get('page'),
                        'per-page' => Yii::$app->request->get('per-page'),
                    ], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light my-1'])
                    : '' 
                ?>
                <?= $status === 'В работе' || $status === 'В ремонте' || $status === 'Сломан' || $status === 'Утерян'
                    ? Html::a('<i class="fas fa-undo"></i> Вернуть на склад', [
                        'return', 
                        'id' => $model->id,
                        'page' => Yii::$app->request->get('page'),
                        'per-page' => Yii::$app->request->get('per-page'),
                    ], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light my-1'])
                    : '' 
                ?>
                <?= ($status !== 'В ремонте' && $status !== 'Сломан' && $status !== 'Утерян')
                    ? Html::a('<i class="fas fa-exclamation-triangle"></i> Инструмент сломан', [
                        'broken', 
                        'id' => $model->id,
                        'page' => Yii::$app->request->get('page'),
                        'per-page' => Yii::$app->request->get('per-page'),
                    ], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light my-1'])
                    : ''
                ?>
                <?= ($status !== 'В ремонте' && $status !== 'Утерян')
                    ? Html::a('<i class="fas fa-wrench"></i> Сдать в ремонт', [
                        'repair', 
                        'id' => $model->id,
                        'page' => Yii::$app->request->get('page'),
                        'per-page' => Yii::$app->request->get('per-page'),
                    ], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light my-1'])
                    : ''
                ?>
                <?= $status !== 'Утерян'
                    ? Html::a('<i class="fas fa-ban"></i> Инструмент утерян', [
                        'loss', 
                        'id' => $model->id,
                        'page' => Yii::$app->request->get('page'),
                        'per-page' => Yii::$app->request->get('per-page'),
                    ], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light my-1'])
                    : ''
                ?>

            </div>
        </div>
    </div>


</div>
