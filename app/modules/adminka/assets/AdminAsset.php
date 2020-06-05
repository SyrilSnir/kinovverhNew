<?php

namespace app\modules\adminka\assets;

use yii\web\AssetBundle;
use dmstr\web\AdminLteAsset;

/**
 * Description of AdminAsset
 *
 * @author kotov
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/main.css'
    ];
    
    public $js = [
        'build/manifest.js',
        'build/main.js'
    ];
}
