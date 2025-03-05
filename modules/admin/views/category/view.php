<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Category $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('<i class="fas fa-arrow-left"></i> Назад', ['index'], ['class' => 'btn btn-outline-info rounded-pill btn-wave waves-effect waves-light']) ?>
</p>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body h-100">
                <div class="row ">
                    <div class="details col-xl-7 col-lg-12 col-md-12 mt-3 mt-xl-0">
                        <h5 class="product-title mb-1"><?= Html::encode($model->id . '. ' . $model->title) ?></h5>
                        
                        <div class="product-info mt-2">
                            <p class="product-description mb-1 bg-light p-2 rounded">
                                <i class="fa-solid fa-clock-rotate-left"></i> 
                                    Дата и время создания: <strong><span class="text-primary">
                                    <?= Html::encode(Yii::$app->formatter->asDatetime($model->created_at, 'php: H:i d.m.Y')) ?></span></strong>
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
