<?php
/* @var $filmLists app\core\repositories\Films\FilmList[] */
/* @var $filmList app\core\repositories\Films\FilmList */

?>
<?php foreach ($filmLists as $filmList): ?>
<p class="h-title"><?php echo $filmList->name ?></p>
<div class="row">
<?php foreach ($filmList->films as $film): ?>
<?php echo $this->render('film.info.php',[
    'film' => $film
])?>

<?php endforeach; ?>
</div>
<?php endforeach; ?>

