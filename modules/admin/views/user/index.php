<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use yii\bootstrap5\Modal;
use yii\web\YiiAsset;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\ToolSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(
            '<i class="fas fa-plus"></i> Создать пользователя',
            ['/site/register'],
            ['class' => 'btn btn-outline-success rounded-pill btn-wave mt-3 create-user-modal-btn']
        ) ?>
    </p>

    <?php
    Modal::begin([
        'id' => 'user-index-modal',
        'title' => '<h3>Регистрация пользователя</h3>',
        'size' => Modal::SIZE_LARGE,
    ]);

    echo 'Say hello...';

    Modal::end();
    ?>

    <?php Pjax::begin(); ?>
    <div class="row">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="col-xl-9 col-lg-8 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' => [
                                'class' => 'table text-nowrap table-striped-columns',
                            ],
                            'layout' => "{summary}\n<div class='my-3'>{items}</div>\n{pager}",
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'id',
                                    'headerOptions' => ['class' => 'table-row-sm'],
                                ],
                                [
                                    'attribute' => 'name',
                                    'format' => 'raw', // Разрешаем вывод HTML
                                    'value' => function ($model) {
                                        return Html::a(
                                            Html::encode($model->name . ' ' . $model->surname),
                                            ['/common/profile/view', 'id' => $model->id],
                                            ['class' => 'text-decoration-none text-hover-primary']
                                        );
                                    },
                                ],
                                'email:email',
                                'phone',
                                [
                                    'class' => ActionColumn::class,
                                    'urlCreator' => function ($action, User $model, $key, $index, $column) {
                                        return Url::toRoute([$action, 'id' => $model->id]);
                                    }
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php Pjax::end(); ?>


</div>

<?php
$this->registerJsFile('/js/admin/user-index-modal.js', ['depends' => YiiAsset::class]);
?>