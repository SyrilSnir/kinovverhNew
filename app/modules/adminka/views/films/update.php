<?php
/* @var $this yii\web\View */

$this->title = 'Редактирование';
?>

<div class="film-update">
    <?php echo $this->render('_form', [
        'model' => $model,
        'update' => true,
        'filmId' => $filmId,
        'galleryImageList' => $galleryImageList,
        'trailersVideoList' => $trailersVideoList,
        'personList' => $personList
    ]) ?>
</div>
