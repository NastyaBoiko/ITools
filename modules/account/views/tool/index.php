<?php

use app\models\Tool;
use yii\bootstrap5\LinkPager;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\web\JqueryAsset;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\ToolSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $myTools ? 'Мои инструменты' : 'Инструменты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tool-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin([
        'id' => 'account-tool-pjax',
    ]); ?>

    <div class="row my-3">
        <?php echo $this->render(($myTools ? '_my-search' : '_search'), [
            'model' => $searchModel,
            'statuses' => $statuses,
            'users' => $users,
            'locations' => $locations,
            'materialsMadeOf' => $materialsMadeOf,
        ]); ?>

        <div class="col-xl-9 col-lg-8 col-md-12">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'col-md-6 col-lg-6 col-xl-4 col-sm-6 mb-3'],
                'layout' => "{summary}<div class='my-3'></div>{pager}<div class='row'>\n{items}</div>{pager}",
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

<?php

if ($dataProvider->count) {
    Modal::begin([
        'id' => 'return-modal',
        'title' => '<h2>Возвращение на склад</h2>',
        // 'size' => 'modal-lg',
    ]);

    Modal::end();

    $this->registerJsFile('/js/return-modal.js', ['depends' => JqueryAsset::class]);
}

$this->registerJsFile('/js/pjax-reload-btns.js', ['depends' => JqueryAsset::class]);

$this->registerJsFile('/js/account/tool-search.js', ['depends' => JqueryAsset::class]);

?>