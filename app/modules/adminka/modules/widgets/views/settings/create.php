<?php
/* @var $this yii\web\View */

$this->title = 'Новый виджет';
?>

<div class="widget-create">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

