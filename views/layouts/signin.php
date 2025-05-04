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

    <div class="container-fluid custom-page">
        <div class="row bg-white">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent-3">
                <div class="row w-100 mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto w-100">
                        <img src="/img/login_left.jpg" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto rounded" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-3 d-flex">
                                        <a href="/" class="header-logo">
                                            <img src="/img/logo_itools_no-text.png" class="desktop-logo ht-40 rounded" alt="logo">
                                            <img src="/img/logo_itools_no-text.png" class="desktop-white ht-40 rounded" alt="logo">
                                        </a>
                                    </div>

                                    <!-- Start::app-content -->
                                    <main class="card-sigin">
                                        <div class="main-signup-header">
                                            <?php if (!empty($this->params['breadcrumbs'])): ?>
                                                <?php Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                                            <?php endif ?>
                                            <?= Alert::widget() ?>
                                            <?= $content ?>
                                        </div>
                                    </main>
                                    <!-- End::app-content -->

                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>