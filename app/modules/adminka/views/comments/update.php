<?php
/* @var $this yii\web\View */

$this->title = 'Редактирование комментария';
?>

<div class="comment-update">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

