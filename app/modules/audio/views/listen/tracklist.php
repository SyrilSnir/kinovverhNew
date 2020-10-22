<?php

use app\models\ActiveRecord\Audio\Album;
use app\widgets\Audio\AlbumPlayWidget;
use yii\web\View;

/** @var View $this */
/** @var Album $album */
$title = mb_strtoupper($album->name);
$this->title = $title;

?>
<div class="audio_block">    
    <div class="container">
<div class="head-wrapper">

    <img src="<?=$album->image_url?>" class="img-rounded img-responsive">
    <h2><?=$album->singers?></h2>
    <h1><?=$title?></h1>

</div>
        <?php echo AlbumPlayWidget::widget([
            'album' => $album
        ]); ?>
    </div>
</div>

