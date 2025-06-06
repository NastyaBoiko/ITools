<?php

use yii\bootstrap5\Html;

?>

<div class="card custom-card border h-100" style="background-color: #f8f9fa;">
    <div class="card-body p-2 d-flex flex-column justify-content-between">
        <div class="product-info mx-2">
            <h5 class="product-title mb-1"><?= Html::encode($model->id . '. ' . $model->title) ?></h5>
            <p class="product-description mb-1 bg-light p-2 rounded">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Создано: <strong><span class="text-primary">
                        <?= Html::encode(Yii::$app->formatter->asDatetime($model->created_at, 'php: d.m.Y H:i')) ?></span></strong>
            </p>
        </div>
        <div class="d-flex gap-3 justify-content-between mt-3">
            <?= Html::a('<i class="fas fa-edit"></i> Изменить', ['ajax-update', 'id' => $model->id], ['class' => 'btn btn-outline-success rounded-pill btn-wave waves-effect waves-light update-location-btn', 'data-id' => $model->id]) ?>
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