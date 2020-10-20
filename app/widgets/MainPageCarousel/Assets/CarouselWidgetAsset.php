<?php

namespace app\widgets\MainPageCarousel\Assets;

use app\assets\OwlCarouselAsset;
use yii\web\AssetBundle;

/**
 * Description of CarouselWidgetAsset
 *
 * @author kotov
 */
class CarouselWidgetAsset extends AssetBundle
{
    public $sourcePath = '@widgets/MainPageCarousel/Assets/src';
    
    public $js = [
        'js/main.js'
    ]; 
    
    public $css = [
      'css/main.css'  
    ];


    public $depends = [
      OwlCarouselAsset::class  
    ];

    public $publishOptions = [
        'forceCopy'=> true,
    ];     
}
