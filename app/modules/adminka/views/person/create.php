<?php
/* @var $this yii\web\View */

$this->title = 'Новая персона';
?>

<div class="person-create">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

