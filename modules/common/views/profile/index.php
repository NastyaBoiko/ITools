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

    <!-- Start::row-1 -->
    <div class="row row-sm">
        <div class="col-xl-4 py-0">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="ps-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user user-profile">
                                <img alt="Аватар" src="<?= Html::encode('/avatars/' . (Yii::$app->user->identity->userExtras->avatar ?? 'no_image.jpg')) ?>">
                                <!-- <a class="fe fe-camera profile-edit text-primary" href="JavaScript:void(0);"></a> -->
                            </div>
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
                                        <div class="media-icon bg-info-transparent text-info">
                                            <i class="fa-brands fa-telegram"></i>
                                        </div>
                                        <div class="media-body">
                                            <span>Telegram</span> <a href="<?= Html::encode(Yii::$app->user->identity->userExtras->telegramHref) ?>" class="text-primary"><?= Html::encode(Yii::$app->user->identity->userExtras->telegram) ?></a>
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
                                <div class="media">
                                    <div class="media-icon bg-warning-transparent text-warning">
                                        <i class="fa-solid fa-square-envelope"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Почта</span> <a href="mailto:<?= Html::encode(Yii::$app->user->identity->email) ?>" class="text-primary"><?= Html::encode(Yii::$app->user->identity->email) ?></a>
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
                                <a href="#home" data-bs-toggle="tab" aria-expanded="<?= $index ?>" aria-selected="<?= $index ?>" role="tab" class="<?= $index ? 'active' : '' ?>"> <span class="visible-xs"><i class="las la-user-circle fs-16 me-1"></i></span> <span class="hidden-xs">Обо мне</span> </a>
                            </li>
                            <li class="">
                                <a href="#settings" data-bs-toggle="tab" aria-expanded="<?= $settings ?>" aria-selected="<?= $settings ?>" role="tab" class="<?= $settings ? 'active' : '' ?>" tabindex="-1"> <span class="visible-xs"><i class="las la-cog fs-16 me-1"></i></span>
                                    <span class="hidden-xs">Настройки</span> </a>
                            </li>
                            <li class="">
                                <a href="#change_password" data-bs-toggle="tab" aria-expanded="<?= $change_password ?>" aria-selected="<?= $change_password ?>" role="tab" class="<?= $change_password ? 'active' : '' ?>" tabindex="-1"> <span class="visible-xs"><i class="las la-cog fs-16 me-1"></i></span>
                                    <span class="hidden-xs">Смена пароля</span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border border-top-0 p-3 br-dark">
                        <div class="tab-pane border-0 p-0 <?= $index ? 'active show' : '' ?>" id="home" role="tabpanel">
                            <h4 class="fs-15 text-uppercase mb-3">Биография</h4>
                            <?= Yii::$app->user->identity->userExtras->about ?? 'Биография не заполнена' ?>
                        </div>
                        <div class="tab-pane border-0 p-0 <?= $settings ? 'active show' : '' ?>" id="settings" role="tabpanel">
                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->name]) ?>

                            <?= $form->field($model, 'surname')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->surname]) ?>

                            <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->patronymic]) ?>

                            <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'phone', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'status')->textInput(['value' => Yii::$app->user->identity->userExtras->status]) ?>

                            <?= $form->field($model, 'position')->textInput(['value' => Yii::$app->user->identity->userExtras->position]) ?>

                            <?= $form->field($model, 'about')->textarea(['rows' => 6, 'value' => Yii::$app->user->identity->userExtras->about]) ?>

                            <?= $form->field($model, 'vk')->textInput(['value' => Yii::$app->user->identity->userExtras->vk]) ?>

                            <?= $form->field($model, 'telegram')->textInput(['value' => Yii::$app->user->identity->userExtras->telegram]) ?>

                            <?= $form->field($model, 'imageFile')->fileInput() ?>

                            <div class="mb-2">Текущее изображение:</div>
                            <?php if (!empty(Yii::$app->user->identity->userExtras->avatar)): ?>
                                <div style="position: relative; display: inline-block;">
                                    <!-- Миниатюра изображения -->
                                    <img src="<?= Yii::getAlias('@web') . '/avatars/' . Html::encode(Yii::$app->user->identity->userExtras->avatar) ?>"
                                        alt="Текущее изображение"
                                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 10%; border: 2px solid #ccc;">

                                    <!-- Крестик для удаления -->
                                    <?= Html::a(
                                        '<i class="fa-solid fa-circle-xmark"></i>',
                                        ['delete-avatar'], // Ссылка на действие для удаления аватара
                                        [
                                            'class' => 'delete-image',
                                            'style' => 'position: absolute; top: 5px; right: 5px; color: #fff; background-color: #ff4d4d; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; text-decoration: none;',
                                            'title' => 'Удалить изображение',
                                            'data-confirm' => 'Вы уверены, что хотите удалить это изображение?', // Подтверждение перед удалением
                                            'data-method' => 'post', // Метод отправки запроса
                                        ]
                                    ) ?>
                                </div>
                            <?php else: ?>
                                <p>Изображение не загружено.</p>
                            <?php endif; ?>

                            <div class="form-group my-3">
                                <?= Html::submitButton('<i class="fas fa-edit"></i> Изменить', ['class' => 'btn btn-outline-success rounded-pill btn-wave waves-effect waves-light']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="tab-pane border-0 p-0 <?= $change_password ? 'active show' : '' ?>" id="change_password" role="tabpanel">
                            <?php $form = ActiveForm::begin([
                                'action' => ['profile/change-password'], // Указываем действие контроллера
                                'method' => 'post', // Метод отправки (POST по умолчанию)
                            ]); ?>

                            <?= $form->field($changePasswordModel, 'old_password', ['enableAjaxValidation' => true])->passwordInput(['maxlength' => true]) ?>

                            <?= $form->field($changePasswordModel, 'password')->passwordInput(['maxlength' => true]) ?>

                            <?= $form->field($changePasswordModel, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

                            <div class="form-group my-3">
                                <?= Html::submitButton('<i class="fas fa-edit"></i> Изменить пароль', ['class' => 'btn btn-outline-success rounded-pill btn-wave waves-effect waves-light']) ?>
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