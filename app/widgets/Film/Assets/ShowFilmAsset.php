<?php

namespace app\widgets\Film\Assets;

use app\assets\VideoJsAsset;
use yii\web\AssetBundle;

/**
 * Description of ShowFilmAsset
 *
 * @author kotov
 */
class ShowFilmAsset extends AssetBundle
{
    public $sourcePath = '@widgets/Film/Assets/src';
    
    public $js = [
        'js/main.js'
    ];
    
    public $depends = [
        VideoJsAsset::class
    ]; 
    
    public $publishOptions = [
        'forceCopy'=>true,
    ];     
    
}
