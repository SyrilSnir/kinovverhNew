<?php
/* @var $this yii\web\View */

$this->title = 'Новый видеоматериал';
?>

<div class="video-create">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

