<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/scroll.css',
        'css/window/style.css',
        'css/download.css',
        'js/fancybox/jquery.fancybox.css',
    ];
    public $js = [
    	'js/main.js',
    	'js/serch_animate.js',
    	'js/show_detailed.js',
    	'js/fancybox/jquery.fancybox.js',
    	'js/scroll/main.js',
    	'js/scroll/modernizr.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
