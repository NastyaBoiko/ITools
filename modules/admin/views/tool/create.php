<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tool $model */

$this->title = 'Создание карточки инструмента';
$this->params['breadcrumbs'][] = ['label' => 'Список инструментов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tool-create">

    <h1 class="my-3"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'locations' => $locations,
        'projects' => $projects,
    ]) ?>

</div>
