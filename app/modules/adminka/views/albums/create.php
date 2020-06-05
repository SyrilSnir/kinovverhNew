<?php
/* @var $this yii\web\View */

$this->title = 'Новый альбом';
?>

<div class="album-create">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

