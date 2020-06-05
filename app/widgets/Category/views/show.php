<?php
/* @var $this yii\web\View */
/* @var $filmLists app\core\repositories\Films\FilmList[] */
/* @var $view string */
?>
<section id="f-pop">
  <?php
    echo $this->render($view,[
        'filmLists' => $filmLists
    ])
  ?> 
</section>

