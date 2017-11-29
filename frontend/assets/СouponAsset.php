<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class СouponAsset extends AssetBundle
{

    public $css = [
        'depend/vendor/bootstrap/css/bootstrap.min.css',
        'depend/vendor/awesome/css/font-awesome.min.css',
        'depend/vendor/slick/slick.css',
        'depend/vendor/slick/slick-theme.css',
        'depend/css/col.css',
        'depend/css/main.css'
    ];
    public $js = [
        //'depend/vendor/jquery/jquery.min.js',
        'depend/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'depend/vendor/slick/slick.js',
        'depend/js/script.js',
        //'depend/js/dist/clipboard.min.js'
    ];

    public $depends = [
       'yii\web\YiiAsset',
    ];


}
