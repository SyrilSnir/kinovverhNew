<?php
/* @var $this yii\web\View */

$this->title = 'Новый фильм';
?>

<div class="film-create">
    <?php echo $this->render('_form', [
        'model' => $model,
        'personList' => $personList
        
    ]) ?>
</div>