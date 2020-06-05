<?php
/* @var $this yii\web\View */

$this->title = 'Редактирование';
?>

<div class="track-update">
    <?php echo $this->render('_form', [
        'model' => $model,
        'albumId' => $albumId
    ]) ?>
</div>
