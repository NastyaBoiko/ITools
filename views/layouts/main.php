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
        
        <!-- Start::Off-canvas sidebar-->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="header-sidebar" aria-labelledby="sidebarLabel">
            <div class="offcanvas-header rounded-0">
                <h5 class="fs-14 text-uppercase mb-0 fw-semibold" id="sidebarLabel">Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body rounded-0 p-0">
                <ul class="nav nav-tabs tab-style-1 d-block" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#chat" aria-current="page" href="#chat" aria-selected="false" role="tab" tabindex="-1"><i class="fe fe-message-circle fs-15 me-2"></i>Chat</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#notifications" href="#notifications" aria-selected="false" role="tab" tabindex="-1"><i class="fe fe-bell fs-15 me-2"></i> Notifications</a>
                    </li>
                    <li class="nav-item mb-0" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#friends" href="#friends" aria-selected="true" role="tab"><i class="fe fe-users fs-15 me-2"></i>Friends</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane border-start-0 border-end-0 rounded-0 p-0" id="chat" role="tabpanel">
                        <div class="list d-flex align-items-center border-bottom p-3">
                            <div class="">
                                <span class="avatar bg-primary rounded-circle avatar-md">CH</span>
                            </div>
                            <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                                <p class="mb-0 d-flex ">
                                    <b>New Websites is Created</b>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                        <small class="text-muted ms-auto">30 mins ago</small>
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="list d-flex align-items-center border-bottom p-3">
                            <div class="">
                                <span class="avatar bg-danger rounded-circle avatar-md">N</span>
                            </div>
                            <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                                <p class="mb-0 d-flex ">
                                    <b>Prepare For the Next Project</b>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                        <small class="text-muted ms-auto">2 hours ago</small>
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="list d-flex align-items-center border-bottom p-3">
                            <div class="">
                                <span class="avatar bg-info rounded-circle avatar-md">S</span>
                            </div>
                            <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                                <p class="mb-0 d-flex ">
                                    <b>Decide the live Discussion</b>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                        <small class="text-muted ms-auto">3 hours ago</small>
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="list d-flex align-items-center border-bottom p-3">
                            <div class="">
                                <span class="avatar bg-warning rounded-circle avatar-md">K</span>
                            </div>
                            <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                                <p class="mb-0 d-flex ">
                                    <b>Meeting at 3:00 pm</b>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                        <small class="text-muted ms-auto">4 hours ago</small>
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="list d-flex align-items-center border-bottom p-3">
                            <div class="">
                                <span class="avatar bg-success rounded-circle avatar-md">R</span>
                            </div>
                            <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                                <p class="mb-0 d-flex ">
                                    <b>Prepare for Presentation</b>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                        <small class="text-muted ms-auto">1 day ago</small>
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="list d-flex align-items-center border-bottom p-3">
                            <div class="">
                                <span class="avatar bg-pink rounded-circle avatar-md">MS</span>
                            </div>
                            <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                                <p class="mb-0 d-flex ">
                                    <b>Prepare for Presentation</b>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                        <small class="text-muted ms-auto">1 day ago</small>
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="list d-flex align-items-center border-bottom p-3">
                            <div class="">
                                <span class="avatar bg-purple rounded-circle avatar-md">L</span>
                            </div>
                            <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                                <p class="mb-0 d-flex ">
                                    <b>Prepare for Presentation</b>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                        <small class="text-muted ms-auto">45 minutes ago</small>
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="list d-flex align-items-center p-3">
                            <div class="">
                                <span class="avatar bg-blue rounded-circle avatar-md">U</span>
                            </div>
                            <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                                <p class="mb-0 d-flex ">
                                    <b>Prepare for Presentation</b>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                        <small class="text-muted ms-auto">2 days ago</small>
                                        <p class="mb-0"></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane border-start-0 border-end-0 rounded-0 p-0" id="notifications" role="tabpanel">
                        <div class="list-group list-group-flush ">
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-lg online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/1.jpg" alt="img">
                                </span>
                                <div class="ms-3">
                                    <strong>Madeleine</strong> Hey! there I' am available....
                                    <div class="small text-muted">
                                        3 hours ago
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-lg online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/2.jpg" alt="img">
                                </span>
                                <div class="ms-3">
                                    <strong>Anthony</strong> New product Launching...
                                    <div class="small text-muted">
                                        5 hour ago
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-lg avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/3.jpg" alt="img">
                                </span>
                                <div class="ms-3">
                                    <strong>Olivia</strong> New Schedule Realease......
                                    <div class="small text-muted">
                                        45 minutes ago
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-lg avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/4.jpg" alt="img">
                                </span>
                                <div class="ms-3">
                                    <strong>Madeleine</strong> Hey! there I' am available....
                                    <div class="small text-muted">
                                        3 hours ago
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-lg avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/5.jpg" alt="img">
                                </span>
                                <div class="ms-3">
                                    <strong>Anthony</strong> New product Launching...
                                    <div class="small text-muted">
                                        5 hour ago
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-lg avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/6.jpg" alt="img">
                                </span>
                                <div class="ms-3">
                                    <strong>Olivia</strong> New Schedule Realease......
                                    <div class="small text-muted">
                                        45 minutes ago
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-lg avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/7.jpg" alt="img">
                                </span>
                                <div class="ms-3">
                                    <strong>Olivia</strong> Hey! there I' am available....
                                    <div class="small text-muted">
                                        12 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane border-start-0 border-end-0 rounded-0 p-0 active show" id="friends" role="tabpanel">
                        <div class="list-group list-group-flush ">
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/1.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Mozelle Belt</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/2.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Florinda Carasco</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel" ><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/5.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Alina Bernier</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/6.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Zula Mclaughin</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/8.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Isidro Heide</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/8.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Mozelle Belt</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" ><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/9.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Florinda Carasco</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/10.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Alina Bernier</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" ><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/11.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Zula Mclaughin</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel" ><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/12.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Isidro Heide</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" ><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/2.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Florinda Carasco</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/2.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Alina Bernier</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/3.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Zula Mclaughin</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex  align-items-center">
                                <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                                    <img src="/valex/assets/images/faces/4.jpg" alt="img">
                                </span>
                                <div class="ms-2">
                                    <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Isidro Heide</div>
                                </div>
                                <div class="ms-auto">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <!-- End::Off-canvas sidebar-->


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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
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
                            <li class="slide__category"><span class="category-name">Категории инструментов</span></li>
                            <!-- End::slide__category -->

                            <!-- Start::slide -->
                            <li class="slide">
                                <a href="/admin/category" class="side-menu__item d-flex align-items-center">
                                    <div class="side-menu__icon">
                                        <i class="fa-solid fa-tags"></i> <!-- Измененная иконка для списка категорий -->
                                    </div>
                                    <span class="side-menu__label text-wrap lh-sm">Список категорий</span>
                                </a>
                            </li>
                            <!-- End::slide -->

                        <?php endif ?>

                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
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
