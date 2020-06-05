<?php
/* @var $this yii\web\View */

$this->title = 'Новый трек';
?>

<div class="track-create">
    <?php echo $this->render('_form', [
        'model' => $model,
        'albumId' => $albumId
        
    ]) ?>
</div>

