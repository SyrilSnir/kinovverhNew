<?php
/* @var $this yii\web\View */

$this->title = 'Изменить элемент';
?>

<div class="widget-update">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
