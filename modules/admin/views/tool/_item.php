<?php

use app\models\Tool;
use yii\bootstrap5\Html;
// dd($model->toolHistories[array_key_last($model->toolHistories)]->toolStatus->title);
$status = '';

?>

<a href="/admin/tool/view?id=<?= $model->id ?>">
    <div class="card custom-card h-100">
        <div class="col-lg-12 col-md-12">
            <div id="carouselExampleControls<?= $model->id ?>" class="carousel slide pointer-event" data-bs-ride="carousel">
                <?php if ($model->toolImages): ?>
                    <div class="carousel-inner">
                        <?php foreach ($model->toolImages as $key => $toolImage): ?>
                            <div class="carousel-item <?= $key === 0 ? "active" : '' ?> ">
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
                <?php else: ?>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <?= Html::img('/img/' . Tool::NO_IMAGE, [
                                'alt' => 'Фото инструмента',
                                'class' => 'd-block w-100',
                                'style' => 'height: 240px; width: 100%; object-fit: cover;' // Задаем высоту и ширину
                            ]) ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <div class="card custom-card border h-100" style="background-color: #f8f9fa;">
            <div class="card-body p-2 d-flex flex-column justify-content-between">
                <div class="card-description">
                    <div class="product-info mx-2">
                        <h5 class="product-title mb-1"><?= Html::encode($model->id . '. ' . $model->toolMaker->title) ?></h5>
                        <p class="text-muted fs-14 mb-1"><i class="fas fa-folder"></i> <?= Html::encode($model->category->title) ?></p>

                    </div>

                    <div class="product-info mt-2">
                        <p class="product-description mb-1 bg-light p-2 rounded">
                            <i class="fas fa-info-circle"></i>
                            Статус: <strong><span class="">
                                    <?= Html::encode($status = $model->toolHistories[array_key_last($model->toolHistories)]->toolStatus->title) ?></span></strong>
                        </p>
                        <p class="product-description mb-1 bg-light p-2 rounded">
                            <i class="fas fa-user"></i>
                            Последнее использование: <strong><span class="">
                                    <?= Html::encode($model->toolHistories[array_key_last($model->toolHistories)]->user->surname) ?></span></strong>
                        </p>
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
                    </div>
                </div>
                <div class="d-grid gap-1">
                    <?= Html::a('<i class="fas fa-eye"></i> Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light my-1']) ?>
                </div>
            </div>
        </div>
    </div>
</a>
