<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Изменение настроек пользователя: ' . $model->name . " " . $model->surname;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['/common/profile/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить настройки';
?>
<div class="user-update">

    <h3 class="my-3"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>