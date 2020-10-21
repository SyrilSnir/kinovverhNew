<?php

use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\ListView;

/** @var View $this */
/** @var ActiveDataProvider $albums */

$title = mb_uppercase('Альбомы');
$this->title = $title;
//dump($albums);
?>
<div class="audio_block">
    
    <div class="container">
        <p class="h-title"><?php echo $title ?></p>  
        <?php 
        echo ListView::widget([
            'dataProvider' => $albums,
            'layout' => "{items}\n{pager}",
            'itemView' => '_album',
        ]);
        ?>
    </div>
</div>


