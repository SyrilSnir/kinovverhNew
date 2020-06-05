<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of BaseAsset
 *
 * @author kotov
 */
class BaseAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/font-awesome.min.css',
        'css/bootstrap.css'        
    ];
    
    public $js = [
        'build/manifest.js',
        'build/main.js',
        'build/index.js',
    ];
}
