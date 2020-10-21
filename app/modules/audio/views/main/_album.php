<?php

use app\models\ActiveRecord\Audio\Album;
use yii\web\View;

/* @var $this View */
/* @var $model Album */

//dump ($model);
$singersList = $model->singersList;
?>
<div class="pop-film pop-film__left">
    <div class="pop-film__wrapp" data-id="<?php echo $model->id ?>">
        <a class="pop-film__play" href="<?php echo $model->url ?>"></a>
        <span class="pop-film__vozr">Аудиокниги</span>
        <div class="pop-film__data hidden-mobile">
            <div class="pop-film__arrow"></div>
            <div class="pop-film__data-wrap">
                <p>
                    <a href="<?php echo $model->url ?>" class="btn btn-xs">Прослушать</a>						
                </p>
            <?php if (!empty($singersList)): ?>
                <?php 
                    $singerHeader = count($singersList) === 1 ? 'Исполнитель' : 'Исполнители';
                ?>
                <p><span><?php echo $singerHeader ?>:</span> <?php echo $model->singers;?></p>
            <?php endif; ?>
            </div>
        </div>
        <a href="<?php echo $model->url ?>"><img src="<?php echo $model->image_url ?>" class="img-rounded img-responsive"></a>
        <div class="pop_film__caption">
            <h3><?php echo $model->name ?></h3>
        </div>
    </div>
</div>