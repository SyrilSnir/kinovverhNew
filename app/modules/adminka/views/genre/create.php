<?php
/* @var $this yii\web\View */

$this->title = 'Новый жанр';
?>

<div class="genre-create">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

