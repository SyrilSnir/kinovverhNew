<?php

use app\models\ActiveRecord\Film\Film;
use app\widgets\Film\ShowFilmWidget;

/* @var $film Film */
?>
<?php if ($film->media): ?>
    <?php 
        echo ShowFilmWidget::widget([
            'media' => $film->media
        ]);
    ?>
<?php else: ?>
<div class="container">
    <div class="alert alert-warning">
        <strong>Внимание!</strong> Фильм не доступен на сервере.
    </div>
</div>
<?php endif ;?>


