<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of VideoJsAsset
 *
 * @author kotov
 */
class VideoJsAsset extends AssetBundle
{
    public  $css = [
      'css/video-js.css'
    ];
    
    public $js = [
      "https://vjs.zencdn.net/7.6.5/video.js"
    ];
    
    public $depends = [
        BaseAsset::class
    ];
}
