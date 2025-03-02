<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tool $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tool-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
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
                            <div class=" col-xl-5 col-lg-12 col-md-12">
                                <div id="carouselExampleControls" class="carousel slide pointer-event" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item">
                                            <img src="/uploads/1.jpg" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="/uploads/3.jpg" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item active">
                                            <img src="/uploads/3.jpg" class="d-block w-100" alt="...">
                                        </div>
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
                                <!-- <div class="product-carousel  border br-5">
                                    <div id="Slider" class="carousel slide" data-bs-ride="false">
                                        <div class="carousel-inner py-3">
                                            <div class="carousel-item active"><img src="/uploads/1.jpg" alt="img" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="carousel-item"> <img src="/uploads/2.jpeg" alt="img" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="carousel-item"> <img src="/uploads/3.jpg" alt="img" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="carousel-item"> <img src="/uploads/4.jpg" alt="img" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="carousel-item"> <img src="/uploads/5.jpg" alt="img" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix carousel-slider">
                                    <div id="thumbcarousel" class="carousel slide mt-2" data-bs-interval="t">
                                        <div class="carousel-inner">
                                            <ul class="carousel-item active d-flex justify-content-center list-unstyled nav mt-2">
                                                <li data-bs-target="#Slider" data-bs-slide-to="0" class="thumb wd-18 active my-2"><img src="../assets/images/ecommerce/13.png" alt="img"></li>
                                                <li data-bs-target="#Slider" data-bs-slide-to="1" class="thumb wd-18 my-2"><img src="../assets/images/ecommerce/14.png" alt="img"></li>
                                                <li data-bs-target="#Slider" data-bs-slide-to="2" class="thumb wd-18 my-2"><img src="../assets/images/ecommerce/15.png" alt="img"></li>
                                                <li data-bs-target="#Slider" data-bs-slide-to="3" class="thumb wd-18 my-2"><img src="../assets/images/ecommerce/16.png" alt="img"></li>
                                                <li data-bs-target="#Slider" data-bs-slide-to="4" class="thumb wd-18 my-2"><img src="../assets/images/ecommerce/17.png" alt="img"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
