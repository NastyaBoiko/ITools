<?php

use app\models\Tool;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\models\User;
/** @var yii\web\View $this */
/** @var app\modules\admin\models\ToolSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> Создать пользователя', ['/site/register'], ['class' => 'btn btn-outline-success rounded-pill btn-wave mt-3']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <div class="row">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    
        <div class="col-xl-9 col-lg-8 col-md-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'id',
                        'headerOptions' => ['class' => 'table-row-sm'],
                    ],
                    'created_at',
                    [
                        'attribute' => 'name',
                        'value' => fn($model) => $model->name . ' ' . $model->surname,
                    ],
                    // 'patronymic',
                    'email:email',
                    //'password',
                    'phone',
                    //'role_id',
                    //'auth_key',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, User $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <?php Pjax::end(); ?>


</div>
