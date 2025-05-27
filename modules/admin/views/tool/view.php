<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tool $model */

$this->title = $model->id . '. ' . $model->toolMaker->title;
$this->params['breadcrumbs'][] = ['label' => 'Инструменты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
// dd($model->toolImages);
?>
<div class="tool-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Назад', ['index'], ['class' => 'btn btn-outline-info rounded-pill btn-wave waves-effect waves-light']) ?>
    </p>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body h-100">
                    <div class="row">
                        <?php if ($model->qr): ?>
                            <div class="qr-code">
                                <?= Html::img('/img/qr/' . $model->qr, [
                                    'alt' => 'Qr инструмента',
                                    'class' => '',
                                ]) ?>
                            </div>
                        <?php endif ?>

                        <?php if ($model->toolImages): ?>
                            <div class="col-xl-5 col-lg-12 col-md-12">
                                <div id="carouselExampleControls" class="carousel slide pointer-event" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($model->toolImages as $key => $toolImage): ?>
                                            <div class="carousel-item <?= $key === 0 ? "active" : '' ?> ">
                                                <?= Html::img('/' . $model::IMG_PATH . $toolImage->image, [
                                                    'alt' => 'Фото инструмента',
                                                    'class' => 'd-block w-100',
                                                    'style' => 'height: 300px; width: 100%; object-fit: cover;' // Задаем высоту и ширину
                                                ]) ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                    <?php if (count($model->toolImages) > 1): ?>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="details col-xl-7 col-lg-12 col-md-12 mt-3 mt-xl-0">

                            <h5 class="product-title mb-1"><?= Html::encode($model->toolMaker->title) ?></h5>
                            <p class="text-muted fs-14 mb-1"><i class="fas fa-folder"></i> <?= Html::encode($model->category->title) ?></p>

                            <div class="product-info mt-2">

                                <?php if ($model->toolHistories): ?>
                                    <p class="product-description mb-1 bg-light p-2 rounded">
                                        <i class="fas fa-info-circle"></i>
                                        Статус: <strong><span class="">
                                                <?= Html::encode($lastStatus->title) ?></span></strong>
                                    </p>
                                    <p class="product-description mb-1 bg-light p-2 rounded">
                                        <i class="fas fa-user"></i>
                                        Последнее использование:
                                        <strong>
                                            <?= Html::a(
                                                Html::encode($lastUser->fio), // Текст ссылки (ФИО пользователя)
                                                ['/common/profile/view', 'id' => $lastUser->id], // URL для перехода
                                                ['class' => 'text-decoration-none text-hover-primary'] // Дополнительные атрибуты (стиль ссылки)
                                            ) ?>
                                        </strong>
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
                                    <i class="fas fa-ruler"></i>
                                    Общая длина: <strong><span class="">
                                            <?= Html::encode($model->full_length) . ' мм' ?></span></strong>
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
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fa-solid fa-shield"></i>
                                    Количество в наличии с такими же характеристиками: <strong><span class="">
                                            <?= Html::encode($model->countSame()) ?></span></strong>
                                </p>

                                <?php if ($model->min_amount): ?>
                                    <p class="product-description mb-1 bg-light p-2 rounded">
                                        <i class="fas fa-sort-numeric-up"></i>
                                        Минимально необходимое количество: <strong><span class="">
                                                <?= Html::encode($model->min_amount) ?></span></strong>
                                    </p>
                                <?php endif; ?>

                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-calendar-alt"></i>
                                    Дата и время инвентаризации: <strong><span class="">
                                            <?= Html::encode($model->inventory_time == '' ? 'Не указана' : $model->inventory_time) ?></span></strong>
                                </p>
                            </div>

                            <div class="action mt-3">
                                <?= Html::a('<i class="fas fa-edit"></i> Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-success rounded-pill btn-wave waves-effect waves-light']) ?>
                                <?= Html::a('<i class="fas fa-trash-alt"></i> Удалить', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-outline-danger rounded-pill btn-wave waves-effect waves-light',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                                        'method' => 'post',
                                    ],
                                ]) ?>

                                <?= $model->qr
                                    ? Html::a('<i class="fas fa-download"></i> Скачать qr-код в PDF', ['download-qr', 'id' => $model->id], [
                                        'class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light',
                                        'title' => 'Скачать qr-код',
                                    ])
                                    : ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <h3 class="mt-4 mb-3 text-center">История использования</h3>
        <div class="col-12">
            <div class="card custom-card">
                <!-- <div class="card-header justify-content-between">
                    <div class="card-title">
                        Table Without Borders
                    </div>
                    <div class="prism-toggle">
                        <button class="btn btn-sm btn-primary-light">Show Code<i class="ri-code-line ms-2 d-inline-block align-middle"></i></button>
                    </div>
                </div> -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Пользователь</th>
                                    <!-- <th scope="col">Transaction Id</th> -->
                                    <th scope="col">Дата</th>
                                    <th scope="col">Статус</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($toolHistories as $toolHistory): ?>
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                <span class="avatar avatar-xs me-2 avatar-rounded">
                                                    <img src="<?= Html::encode('/avatars/' . $toolHistory->user->userExtras->avatar) ?>" alt="img">
                                                </span><a href="/common/profile/view?id=<?= $toolHistory->user->id ?>" class="text-decoration-none text-hover-primary"><?= Html::encode($toolHistory->user->fio) ?></a>
                                            </div>
                                        </th>
                                        <!-- <th scope="row"></th> -->
                                        <!-- <td>#5182-3467</td> -->
                                        <td><?= date('d.m.Y H:i', strtotime($toolHistory->created_at)) ?></td>
                                        <td><span class="badge bg-<?= Html::encode($toolHistory->toolStatus->getStatusColor()) ?>"><?= Html::encode($toolHistory->toolStatus->title) ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-none border-top-0">
                    <!-- Prism Code -->
                    <pre class="language-html" tabindex="0"><code class="language-html"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>table-responsive<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                        <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>table</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>table text-nowrap table-borderless<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
                            <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>thead</span><span class="token punctuation">&gt;</span></span>
                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tr</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>col<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>User Name<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>col<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Transaction Id<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>col<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Created<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>col<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Status<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tr</span><span class="token punctuation">&gt;</span></span>
                            <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>thead</span><span class="token punctuation">&gt;</span></span>
                            <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tbody</span><span class="token punctuation">&gt;</span></span>
                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tr</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Harshrath<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>#5182-3467<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>24 May 2022<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>span</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>badge bg-primary<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Fixed<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>span</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tr</span><span class="token punctuation">&gt;</span></span>
                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tr</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Zozo Hadid<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>#5182-3412<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>02 July 2022<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>span</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>badge bg-warning<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>In Progress<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>span</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tr</span><span class="token punctuation">&gt;</span></span>
                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tr</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Martiana<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>#5182-3423<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>15 April 2022<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>span</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>badge bg-success<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Completed<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>span</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tr</span><span class="token punctuation">&gt;</span></span>
                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>tr</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>th</span> <span class="token attr-name">scope</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>row<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Alex Carey<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>th</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>#5182-3456<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span>17 March 2022<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>td</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>span</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>badge bg-danger<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Pending<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>span</span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>td</span><span class="token punctuation">&gt;</span></span>
                                <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tr</span><span class="token punctuation">&gt;</span></span>
                            <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>tbody</span><span class="token punctuation">&gt;</span></span>
                        <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>table</span><span class="token punctuation">&gt;</span></span>
                    <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span></code></pre>
                    <!-- Prism Code -->
                </div>
            </div>
        </div>
    </div>

</div>