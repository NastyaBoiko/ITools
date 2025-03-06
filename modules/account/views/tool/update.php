<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tool $model */

$this->title = 'Изменение инструмента: ' . $model->toolMaker->title;
$this->params['breadcrumbs'][] = ['label' => 'Tools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->toolMaker->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tool-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'locations' => $locations,
        'projects' => $projects,
        'toolMakers' => $toolMakers,
        'materialsMadeOf' => $materialsMadeOf,
        'materialsUseFor' => $materialsUseFor,
        'materialsUseForCurrent' => $materialsUseForCurrent,

    ]) ?>

</div>
