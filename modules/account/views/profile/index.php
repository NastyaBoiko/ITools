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

    <div class="container-fluid">

        <!-- Start::row-1 -->
        <div class="row row-sm">
            <div class="col-xl-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="ps-0">
                            <div class="main-profile-overview">
                                <!-- <div class="main-img-user profile-user user-profile">
                                    <img alt="" src="../assets/images/faces/6.jpg"><a class="fe fe-camera profile-edit text-primary" href="JavaScript:void(0);"></a>
                                </div> -->
                                <div class="d-flex justify-content-between mb-4">
                                    <div>
                                        <h5 class="main-profile-name"><?= Html::encode(Yii::$app->user->identity->fio) ?></h5>
                                        <p class="main-profile-name-text text-muted"><?= Html::encode(Yii::$app->user->identity->userExtras->position) ?></p>
                                    </div>
                                </div>
                                <?php if (Yii::$app->user->identity->userExtras->status): ?>
                                    <h6 class="fs-14">Статус</h6>
                                    <div class="main-profile-bio">
                                        <?= Html::encode(Yii::$app->user->identity->userExtras->status) ?>
                                    </div><!-- main-profile-bio -->
                                <?php endif ?>
                                <label class="main-content-label fs-13 mb-4">Контакты</label>
                                <div class="main-profile-social-list">
                                    <?php if (Yii::$app->user->identity->userExtras->vk): ?>
                                        <div class="media">
                                            <div class="media-icon bg-primary-transparent text-primary">
                                                <i class="fa-brands fa-vk"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>Вконтакте</span> <a href="<?= Html::encode(Yii::$app->user->identity->userExtras->vk) ?>" class="text-primary"><?= Html::encode(Yii::$app->user->identity->userExtras->vk) ?></a>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <?php if (Yii::$app->user->identity->userExtras->telegram): ?>
                                        <div class="media">
                                            <div class="media-icon bg-success-transparent text-success">
                                                <i class="fa-brands fa-telegram"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>Telegram</span> <a href="javascript:void(0);" class="text-primary"><?= Html::encode(Yii::$app->user->identity->userExtras->telegram) ?></a>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <div class="media">
                                        <div class="media-icon bg-success-transparent text-success">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>Телефон</span> <a href="tel:<?= Html::encode(Yii::$app->user->identity->phoneHref) ?>" class="text-primary"><?= Html::encode(Yii::$app->user->identity->phone) ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- main-profile-overview -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="tabs-menu ">
                            <!-- Tabs -->
                            <ul class="nav nav-tabs profile navtab-custom panel-tabs" role="tablist">
                                <li class="">
                                    <a href="#home" data-bs-toggle="tab" aria-expanded="true" aria-selected="true" role="tab" class="active"> <span class="visible-xs"><i class="las la-user-circle fs-16 me-1"></i></span> <span class="hidden-xs">Обо мне</span> </a>
                                </li>
                                <li class="">
                                    <a href="#settings" data-bs-toggle="tab" aria-expanded="false" aria-selected="false" role="tab" class="" tabindex="-1"> <span class="visible-xs"><i class="las la-cog fs-16 me-1"></i></span>
                                        <span class="hidden-xs">Настройки</span> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content border border-top-0 p-4 br-dark">
                            <div class="tab-pane border-0 p-0  active show" id="home" role="tabpanel">
                                <h4 class="fs-15 text-uppercase mb-3">Биография</h4>
                                <?= Yii::$app->user->identity->userExtras->about ?? 'Биография не заполнена' ?>
                            </div>
                            <div class="tab-pane border-0 p-0" id="settings" role="tabpanel">
                                <?php $form = ActiveForm::begin(); ?>

                                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->name]) ?>

                                <?= $form->field($model, 'surname')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->surname]) ?>

                                <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->patronymic]) ?>

                                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->email]) ?>

                                <?= $form->field($model, 'old_password')->passwordInput(['maxlength' => true, 'value' => '']) ?>

                                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->phone]) ?>

                                <?= $form->field($model, 'status')->textInput(['value' => Yii::$app->user->identity->userExtras->status]) ?>

                                <?= $form->field($model, 'position')->textInput(['value' => Yii::$app->user->identity->userExtras->position]) ?>

                                <?= $form->field($model, 'about')->textarea(['rows' => 6, 'value' => Yii::$app->user->identity->userExtras->about]) ?>

                                <?= $form->field($model, 'vk')->textInput(['value' => Yii::$app->user->identity->userExtras->vk]) ?>

                                <?= $form->field($model, 'telegram')->textInput(['value' => Yii::$app->user->identity->userExtras->telegram]) ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End::row-1 -->

    </div>

</div>