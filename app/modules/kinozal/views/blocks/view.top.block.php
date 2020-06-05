<?php
/* @var $film app\models\ActiveRecord\Film\Film */
?>
<?php if ($film->media): ?>
<section class="section-1 film">
    <div class="container" >
        <div class="row film m-row">
            <?php // ПРОСМОТР ФИЛЬМА VIEW_COUNT -1 53
            echo "Осталось просмотреть ". (100000 - 1) . " раз.";
            ?>
            <video id="my-video" 
                   class="video-js  vjs-default-skin vjs-big-play-centered" 
                   width="1000px" 
                   poster="/img/defaultfirstscreen.jpg" 
                   data-height="auto" data-setup='{"language":"ru"}' 
                   controls="controls" preload="auto" 
                   >
                <source src="<?php echo $film->media->url ?>" type='video/mp4; codecs="avc1.4D401E, mp4a.40.2"'><!--type='video/mp4'   autoplay="autoplay"-->
                    <track kind="subtitles" src="" srclang="ru" label="Русский" default>
                        <p class="vjs-no-js">
                          To view this video please enable JavaScript, and consider upgrading to a web browser that
                          <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
            </video>
        </div>
    </div>
</section>
<script src="https://vjs.zencdn.net/7.6.5/video.js"></script>
<script type="text/javascript">
    videojs.addLanguage("ru",{
  "Play": "Воспроизвести",
  "Pause": "Приостановить",
  "Current Time": "Текущее время",
  "Duration Time": "Продолжительность",
  "Remaining Time": "Оставшееся время",
  "Stream Type": "Тип потока",
  "LIVE": "ОНЛАЙН",
  "Loaded": "Загрузка",
  "Progress": "Прогресс",
  "Fullscreen": "Полноэкранный режим",
  "Non-Fullscreen": "Неполноэкранный режим",
  "Mute": "Без звука",
  "Unmute": "Со звуком",
  "Playback Rate": "Скорость воспроизведения",
  "Subtitles": "Субтитры",
  "subtitles off": "Субтитры выкл.",
  "Captions": "Подписи",
  "captions off": "Подписи выкл.",
  "Chapters": "Главы",
  "You aborted the media playback": "Вы прервали воспроизведение видео",
  "A network error caused the media download to fail part-way.": "Ошибка сети вызвала сбой во время загрузки видео.",
  "The media could not be loaded, either because the server or network failed or because the format is not supported.": "Невозможно загрузить видео из-за сетевого или серверного сбоя либо формат не поддерживается.",
  "The media playback was aborted due to a corruption problem or because the media used features your browser did not support.": "Воспроизведение видео было приостановлено из-за повреждения либо в связи с тем, что видео использует функции, неподдерживаемые вашим браузером.",
  "No compatible source was found for this media.": "Совместимые источники для этого видео отсутствуют."
});
var myVideo = document.getElementById("my-video");
if (myVideo) {
        myVideo.addEventListener('contextmenu', function(e) {
                        e.preventDefault();
                            }, false);
};
</script>
<?php endif ;?>


