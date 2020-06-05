<?php
/* @var $this yii\web\View */

$this->title = 'Новый комментарий';
?>

<div class="comment-create">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

