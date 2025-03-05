<?php

use yii\bootstrap5\Html;

?>
                     
<div class="card custom-card">
    <div class="card custom-card border" style="background-color: #f8f9fa;">
        <div class="card-body p-2">
            <div class="product-info mx-2">
                <h5 class="product-title mb-1"><?= Html::encode($model->id . '. ' . $model->surname) ?></h5>
            </div>
            
            <div class="product-info mt-2">
                <p class="product-description mb-1 bg-light p-2 rounded">
                    <i class="fas fa-cogs"></i> 
                    Email: <strong><span class="text-primary">
                        <?= Html::encode($model->email) ?></span></strong>
                </p>
                
            </div>
            <div class="d-grid gap-2">
                <?= Html::a('<i class="fas fa-eye"></i> Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light my-1']) ?>
            </div>
        </div>
    </div>


</div>
