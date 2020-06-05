<?php

/* @var $this yii\web\View */
/* @var $model  app\models\Forms\Media\VideoFileForm */

$this->title = 'Редактировать аудиоматериал: ' . $model->description;
?>
<div class="audio-material-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
