<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of JPlayerAsset
 *
 * @author kotov
 */
class JPlayerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web'; 
    
    public $js = [
        'js/jquery/jquery.jplayer.min.js'
    ];
    
    public $depends = [
        BaseAsset::class
    ];    
}
