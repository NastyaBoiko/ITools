<?php

use app\models\Category;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\admin\models\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> Создать категорию', ['create'], ['class' => 'btn btn-outline-success rounded-pill btn-wave mt-3']) ?>
    </p>

    <?php Pjax::begin(); ?>
        <div class="row">
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
