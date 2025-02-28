<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ValexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // "/valex/assets/libs/bootstrap/css/bootstrap.min.css",
        "/valex/assets/css/styles.min.css",
        "/valex/assets/libs/node-waves/waves.min.css",
        "/valex/assets/libs/simplebar/simplebar.min.css",
        "/valex/assets/libs/flatpickr/flatpickr.min.css",
        "/valex/assets/libs/@simonwep/pickr/themes/nano.min.css",
        "/valex/assets/libs/choices.js/public/assets/styles/choices.min.css",
        "/valex/assets/libs/jsvectormap/css/jsvectormap.min.css",
        "/valex/assets/icon-fonts/feather/feather.css",
        "/css/valex.css",
    ];
    public $js = [
        // "https://kit.fontawesome.com/0cec92e36b.js",
        // <!-- Choices JS -->
        "/valex/assets/libs/choices.js/public/assets/scripts/choices.min.js",
        // <!-- Main Theme Js -->
        "/valex/assets/js/main.js",
        // <!-- Popper JS -->
        "/valex/assets/libs/@popperjs/core/umd/popper.min.js",
        // <!-- Bootstrap JS -->
        // "/valex/assets/libs/bootstrap/js/bootstrap.bundle.min.js",
        // <!-- Defaultmenu JS -->
        "/valex/assets/js/defaultmenu.min.js",
        // <!-- Node Waves JS-->
        // "/valex/assets/libs/node-waves/waves.min.js",
        // <!-- Sticky JS -->
        "/valex/assets/js/sticky.js",
        // <!-- Simplebar JS -->
        "/valex/assets/libs/simplebar/simplebar.min.js",
        "/valex/assets/js/simplebar.js",
        // <!-- Color Picker JS -->
        "/valex/assets/libs/@simonwep/pickr/pickr.es5.min.js",
        // <!-- Apex Charts JS -->
        "/valex/assets/libs/apexcharts/apexcharts.min.js",
        // <!-- JSVector Maps JS -->
        "/valex/assets/libs/jsvectormap/js/jsvectormap.min.js",
        // <!-- JSVector Maps MapsJS -->
        "/valex/assets/libs/jsvectormap/maps/world-merc.js",
        "/valex/assets/js/us-merc-en.js",
        // <!-- Chartjs Chart JS -->
        "/valex/assets/js/index.js",
        // <!-- Custom-Switcher JS -->
        // "/valex/assets/js/custom-switcher.min.js",
        // <!-- Custom JS -->
        // "/valex/assets/js/custom.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}

