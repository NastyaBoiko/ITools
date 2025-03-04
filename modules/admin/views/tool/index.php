<?php

use app\models\Tool;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\admin\models\ToolSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Инструменты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tool-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> Создать инструмент', ['create'], ['class' => 'btn btn-outline-success rounded-pill btn-wave mt-3']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3'],
        'layout' => "{summary}<div class='row my-3'>\n{items}</div>{pager}",
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_item', [
                'model' => $model,
            ]);
        },
    ]) ?>

    <?php Pjax::end(); ?>

</div>
