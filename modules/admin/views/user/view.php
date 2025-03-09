<?php

use app\models\Role;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php Html::a('Назад', ['index'], ['class' => 'btn btn-info']) ?>
        <?php Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            [
                'attribute' => 'name',
                'value' => $model->name . ' ' . $model->surname,
            ],
            'email:email',
            // 'password',
            'phone',
            // 'role_id',
            // 'auth_key',
        ],
    ]) ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body h-100">
                    <div class="row ">
                        <div class="details col-xl-7 col-lg-12 col-md-12 mt-3 mt-xl-0">
                            <h5 class="product-title mb-2"><?= Html::encode($model->id . '. ' . $model->name . ' ' . $model->surname . ' ' . $model->patronymic) ?></h5>
                            <p class="text-muted fs-14 mb-2"><i class="fas fa-user-tag"></i> Роль: <?= Html::encode(Role::getRoleTranslate($model->role->title)) ?></p>

                            <div class="product-info mt-2">
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-envelope"></i>
                                    Почта: <strong><span class="">
                                            <?= Html::encode($model->email) ?></span></strong>
                                </p>
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-phone-alt"></i>
                                    Телефон: <strong><span class="">
                                            <?= Html::encode($model->phone) ?></span></strong>
                                </p>
                                <p class="product-description mb-1 bg-light p-2 rounded">
                                    <i class="fas fa-calendar-alt"></i>
                                    Дата и время регистрации: <strong><span class="">
                                            <?= Html::encode(Yii::$app->formatter->asDatetime($model->created_at, 'php: d.m.Y H:i')) ?></span></strong>
                                </p>
                            </div>

                            <div class="action mt-3">
                                <?= Html::a('<i class="fas fa-arrow-left"></i> Назад', ['index'], ['class' => 'btn btn-outline-info rounded-pill btn-wave waves-effect waves-light']) ?>
                                <?= Html::a('<i class="fas fa-edit"></i> Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light']) ?>
                                <?= Html::a('<i class="fas fa-trash-alt"></i> Удалить', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-outline-danger rounded-pill btn-wave waves-effect waves-light',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить пользователя?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>