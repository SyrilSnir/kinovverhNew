<?php

/* @var $this yii\web\View */
/* @var $model  app\models\Forms\Media\VideoFileForm */

$this->title = 'Редактировать видеоматериал: ' . $model->description;
?>
<div class="video-material-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
