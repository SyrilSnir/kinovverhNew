<?php

use app\models\ActiveRecord\Film\Film;
use app\widgets\Film\ShowFilmWidget;
/* @var $film Film */

        echo ShowFilmWidget::widget([
            'media' => $film->kinopanorama
        ]);    
?>

                            

