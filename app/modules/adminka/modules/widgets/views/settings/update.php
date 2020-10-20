<?php
/* @var $this yii\web\View */

$this->title = 'Изменить виджет';
?>

<div class="widget-update">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
