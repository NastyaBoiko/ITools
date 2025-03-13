<?php

use yii\bootstrap5\Html;

?>

<div class="card custom-card">
    <div class="card custom-card border" style="background-color: #f8f9fa;">
        <div class="card-body p-2">
            <div class="product-info mx-2">
                <h5 class="product-title mb-1"><?= Html::encode($model->id . '. ' . $model->title) ?></h5>
            </div>
            <div class="d-grid gap-2">
                <?= Html::a('<i class="fas fa-eye"></i> Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light my-1']) ?>
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