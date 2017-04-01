<?php

namespace xutl\barrager;

use yii\web\AssetBundle;

/**
 * Class BarragerAsset
 * @package xutl\barrager
 */
class BarragerAsset extends AssetBundle
{

    public $sourcePath = '@vendor/xutl/yii2-barrager-widget/assets';

    public $css = [
        'css/barrager.css'
    ];

    public $js = [
        'js/jquery.barrager.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
