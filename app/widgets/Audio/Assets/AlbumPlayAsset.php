<?php

namespace app\widgets\Audio\Assets;

use app\assets\JPlayerAsset;
use yii\web\AssetBundle;

/**
 * Description of AlbumPlayAsset
 *
 * @author kotov
 */
class AlbumPlayAsset extends AssetBundle
{
    public $sourcePath = '@widgets/Audio/Assets/src';
    
    public $css = [
        'css/player.css'
    ];
    
    public $js = [
        'js/main.js'
    ];

    public $depends = [
      JPlayerAsset::class  
    ];
    
    public $publishOptions = [
        'forceCopy'=> true,
    ];      
}
