<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\ValexAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;

ValexAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="/valex/assets/images/brand-logos/favicon.ico" type="image/x-icon">

    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="page">
        <!-- app-header -->
        <header class="app-header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <a href="index.html" class="header-logo">
                                <img src="/img/logo_itools_no-text.png" alt="logo" class="desktop-logo">
                                <img src="/img/logo_itools_no-text.png" alt="logo" class="toggle-logo">
                                <img src="/img/logo_itools_no-text.png" alt="logo" class="desktop-white">
                                <img src="/img/logo_itools_no-text.png" alt="logo" class="toggle-white">
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link -->
                        <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);">
                            <i class="header-icon fe fe-align-left"></i>
                        </a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->
                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <div class="header-content-right">

                    <?= Yii::$app->user->isGuest
                        ? Html::a('Вход', ['/site/login'], ['class' => 'btn btn-outline-primary rounded-pill btn-wave mx-3'])
                        : Html::beginForm(['/site/logout'])
                        . Html::submitButton(
                            '<i class="fas fa-sign-out-alt mx-1"></i> Выход (' . Yii::$app->user->identity->surname . ')',
                            ['class' => 'btn btn-outline-primary rounded-pill btn-wave mx-3']
                        )
                        . Html::endForm()
                    ?>

                </div>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->

        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="index.html" class="header-logo">
                    <img src="/img/logo_itools_no-text.png" alt="ITools" class="desktop-logo">
                    <img src="/img/logo_itools_no-text.png" alt="ITools" class="toggle-logo">
                    <img src="/img/logo_itools_no-text.png" alt="ITools" class="desktop-white">
                    <img src="/img/logo_itools_no-text.png" alt="ITools" class="toggle-white">
                </a>
            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                        </svg>
                    </div>
                    <ul class="main-menu w-100">
                        <?php if (!Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin): ?>

                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Инструменты</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="/account" class="side-menu__item d-flex align-items-center">
                                    <div class="side-menu__icon">
                                        <i class="fa-solid fa-wrench"></i> <!-- Измененная иконка для списка инструментов -->
                                    </div>
                                    <span class="side-menu__label text-wrap lh-sm">Список инструментов</span>
                                </a>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="/account/tool/my-tools" class="side-menu__item d-flex align-items-center">
                                    <div class="side-menu__icon">
                                        <i class="fa-solid fa-tools"></i>
                                    </div>
                                    <span class="side-menu__label text-wrap lh-sm">Мои инструменты</span>
                                </a>
                            </li>
                            <!-- End::slide -->

                        <?php endif ?>

                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin): ?>
                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Пользователи</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="/site/register" class="side-menu__item d-flex align-items-center">
                                    <div class="side-menu__icon">
                                        <i class="fe fe-user-plus"></i>
                                    </div>
                                    <span class="side-menu__label text-wrap lh-sm">Регистрация нового</span>
                                </a>
                            </li>
                            <!-- End::slide__category -->
                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="/admin/user" class="side-menu__item d-flex align-items-center">
                                    <div class="side-menu__icon">
                                        <i class="fe fe-users"></i> <!-- Измененная иконка для списка пользователей -->
                                    </div>
                                    <span class="side-menu__label text-wrap lh-sm">Список пользователей</span>
                                </a>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Инструменты</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="/admin" class="side-menu__item d-flex align-items-center">
                                    <div class="side-menu__icon">
                                        <i class="fa-solid fa-wrench"></i> <!-- Измененная иконка для списка инструментов -->
                                    </div>
                                    <span class="side-menu__label text-wrap lh-sm">Список инструментов</span>
                                </a>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="/admin/tool/create" class="side-menu__item d-flex align-items-center">
                                    <div class="side-menu__icon">
                                        <i class="fas fa-plus"></i> <!-- Измененная иконка для создания инструмента -->
                                    </div>
                                    <span class="side-menu__label text-wrap lh-sm">Создать инструмент</span>
                                </a>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Категории инструмента</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="/admin/category" class="side-menu__item d-flex align-items-center">
                                    <div class="side-menu__icon">
                                        <i class="fa-solid fa-tags"></i>
                                    </div>
                                    <span class="side-menu__label text-wrap lh-sm">Список категорий</span>
                                </a>
                            </li>
                            <!-- End::slide -->

                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">Местоположения инструмента</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="/admin/location" class="side-menu__item d-flex align-items-center">
                                    <div class="side-menu__icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <span class="side-menu__label text-wrap lh-sm">Список местоположений</span>
                                </a>
                            </li>
                            <!-- End::slide -->

                        <?php endif ?>

                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                        </svg></div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <main class="main-content app-content">
            <div class="container-fluid p-5">
                <?php if (!empty($this->params['breadcrumbs'])): ?>
                    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                <?php endif ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
        <!-- End::app-content -->

        <footer class="footer mt-auto py-3 bg-white text-center">
            <div class="container">
                <span class="text-muted"> Copyright © <span id="year"></span>
                    <a href="javascript:void(0);" class="text-dark fw-semibold">ITools</a>.
                    All rights reserved
                </span>
            </div>
        </footer>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>