<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of MainAsset
 *
 * @author kotov
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css',
        'css/jquery.bxslider.css',
    ];
    public $js = [
    ];
    
    public $depends = [
        BaseAsset::class
    ];
}

