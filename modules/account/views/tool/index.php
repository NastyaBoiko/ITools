<?php

use app\models\Tool;
use yii\bootstrap5\LinkPager;
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

    <?php Pjax::begin(); ?>
    <div class="row my-3">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    
        <div class="col-xl-9 col-lg-8 col-md-12">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'col-md-6 col-lg-6 col-xl-4 col-sm-6 mb-3'],
                'layout' => "{summary}<div class='my-3'></div>{pager}<div class='row my-3'>\n{items}</div>{pager}",
                'pager' => [
                    'class' => LinkPager::class,
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_item', [
                        'model' => $model,
                    ]);
                },
            ]) ?>
        </div>
    </div>

    <?php Pjax::end(); ?>

</div>
