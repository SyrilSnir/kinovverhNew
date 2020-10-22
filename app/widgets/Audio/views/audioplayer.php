<?php

use app\models\ActiveRecord\Audio\Album;
use app\models\ActiveRecord\Audio\Track;
use app\widgets\Audio\Assets\AlbumPlayAsset;
use yii\web\View;

/** @var View $this */
/** @var Album $album */

AlbumPlayAsset::register($this);

?>
<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<div id="jp_container_1" class="jp-audio">
    <div class="jp-type-single">
        <div class="kv-track-list-wrapper">
            <div class="kv-track-list">
<?php
$counter = 1;
?>
<?php foreach ($album->tracks as $track):?>
                <div class="kv-track" data-track="<?php echo $track->media->url?>">
                    <i class="fa fa-play-circle-o js-audio-play" aria-hidden="true"></i>
                    <i class="fa fa-pause-circle js-audio-pause hide" aria-hidden="true"></i>
                    <span class="kv-track-name"><?=$track->name ?></span>                                        
                </div>                
<?php endforeach; ?>
                <ul class="jp-controls hide">
                    <li><a href="javascript:;" class="jp-play hide" tabindex="1"></a></li>
                    <li><a href="javascript:;" class="jp-pause hide" tabindex="1"></a></li>
                    <li><a href="javascript:;" class="jp-mute hide" tabindex="1" title="mute"></a></li>
                    <li><a href="javascript:;" class="jp-unmute hide" tabindex="1" title="unmute"></a></li>
                </ul>                
            </div>
        </div>
    </div>  
</div>

