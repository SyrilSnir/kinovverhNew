<?php 
use app\widgets\Film\Assets\ShowFilmAsset;

ShowFilmAsset::register($this);
//dump($media); 
?>
<section class="section-1 film">
    <div class="container" >
        <div class="row film m-row">
            <video id="my-video" 
                   class="video-js  vjs-default-skin vjs-big-play-centered" 
                   width="1000px" 
                   poster="/img/defaultfirstscreen.jpg" 
                   data-height="auto" data-setup='{"language":"ru"}' 
                   controls="controls" preload="auto" 
                   >
                <source src="<?php echo $media->url ?>" type='video/mp4; codecs="avc1.4D401E, mp4a.40.2"'><!--type='video/mp4'   autoplay="autoplay"-->
                    <track kind="subtitles" src="" srclang="ru" label="Русский" default>
                        <p class="vjs-no-js">
                          To view this video please enable JavaScript, and consider upgrading to a web browser that
                          <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
            </video>
        </div>
    </div>
</section>

