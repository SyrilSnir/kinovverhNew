<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of OwlCarouselAsset
 *
 * @author kotov
 */
class OwlCarouselAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';   
    
    public $css = [
        'css/owl.carousel.min.css',
        'css/owl.theme.default.min.css'
    ];
    
    public $js = [
        'js/jquery/owl.carousel.min.js'
    ];
    public $depends = [
        BaseAsset::class
    ];    
}
