<?php

use app\models\ActiveRecord\Film\Film;
/* @var $filmLists app\core\repositories\Films\FilmList[] Список разделов */
/* @var $filmList app\core\repositories\Films\FilmList Список фильмов */
/** @var Film $film */
/** @var bool $isFavorites Находится в избранном */
/** @var int $userId ID пользователя */
?>

<?php 
$isFavorites = false;
if (Yii::$app->user->isGuest) {
    
    $guest = true;
    $userId = null;
} else {
    $guest = false;
    $userId = Yii::$app->user->getId();
}
?>
<?php foreach ($filmLists as $filmList): ?>
<p class="h-title"><?php echo $filmList->name ?></p>
<div class="row">
<?php foreach ($filmList->films as $film) {
    if (!$guest) {
        $isFavorites = $film->inFavorites($userId);
    }
    echo $this->render('film.info.php',[
        'film' => $film,
        'favorites' => $isFavorites,
        'userId' => $userId
    ]);

} 
?>
    
</div>
<?php endforeach; ?>

