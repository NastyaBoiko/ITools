<?php

use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\account\models\ProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Назад', Yii::$app->request->referrer ?? ['tool/index'], ['class' => 'btn btn-outline-info rounded-pill btn-wave waves-effect waves-light']) ?>
    </p>

    <!-- Start::row-1 -->
    <div class="row row-sm">
        <div class="col-xl-4 py-0">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="ps-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user user-profile">
                                <img alt="Аватар" src="<?= Html::encode('/avatars/' . ($model->userExtras->avatar ?? 'no_image.jpg')) ?>"><a class="fe fe-camera profile-edit text-primary" href="JavaScript:void(0);"></a>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <h5 class="main-profile-name"><?= Html::encode($model->fio) ?></h5>
                                    <p class="main-profile-name-text text-muted"><?= Html::encode($model->userExtras->position) ?></p>
                                </div>
                            </div>
                            <?php if ($model->userExtras->status): ?>
                                <h6 class="fs-14">Статус</h6>
                                <div class="main-profile-bio">
                                    <?= Html::encode($model->userExtras->status) ?>
                                </div><!-- main-profile-bio -->
                            <?php endif ?>
                            <label class="main-content-label fs-13 mb-4">Контакты</label>
                            <div class="main-profile-social-list">
                                <?php if ($model->userExtras->vk): ?>
                                    <div class="media">
                                        <div class="media-icon bg-primary-transparent text-primary">
                                            <i class="fa-brands fa-vk"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>Вконтакте</span> <a href="<?= Html::encode($model->userExtras->vk) ?>" class="text-primary"><?= Html::encode($model->userExtras->vk) ?></a>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <?php if ($model->userExtras->telegram): ?>
                                    <div class="media">
                                        <div class="media-icon bg-info-transparent text-info">
                                            <i class="fa-brands fa-telegram"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>Telegram</span> <a href="<?= Html::encode($model->userExtras->telegramHref) ?>" class="text-primary"><?= Html::encode($model->userExtras->telegram) ?></a>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="media">
                                    <div class="media-icon bg-success-transparent text-success">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Телефон</span> <a href="tel:<?= Html::encode($model->phoneHref) ?>" class="text-primary"><?= Html::encode($model->phone) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 py-0 pb-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs" role="tablist">
                            <li class="">
                                <a href="#home" data-bs-toggle="tab" aria-expanded="true" aria-selected="true" role="tab" class="active"> <span class="visible-xs"><i class="las la-user-circle fs-16 me-1"></i></span> <span class="hidden-xs">О пользователе</span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border border-top-0 p-3 br-dark">
                        <div class="tab-pane border-0 p-0 active show" id="home" role="tabpanel">
                            <h4 class="fs-15 text-uppercase mb-3">Биография</h4>
                            <?= $model->userExtras->about ?? 'Биография не заполнена' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->
</div>