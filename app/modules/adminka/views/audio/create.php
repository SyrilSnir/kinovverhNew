<?php
/* @var $this yii\web\View */

$this->title = 'Новый аудиотрек';
?>

<div class="audio-create">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

