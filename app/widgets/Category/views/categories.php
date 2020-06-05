
<?php
use yii\helpers\Url;
/* @var $filmLists app\core\repositories\Films\FilmList[] */
/* @var $film app\models\ActiveRecord\Film */
/* @var $this yii\web\View */
// for test
//$filmLists = [];
?>
<div class="container">
    <div class="row">
        <p class="cat-title hidden-mobile">Фильмы</p>
        <?php if (empty($filmLists)): ?>
        <div class="pop-film__data-target hidden-mobile"></div>
            <div class="alert alert-danger">
                <strong>Внимание!</strong> Список категорий пуст.
            </div>
        <?php else: ?>
            
            <?php foreach ($filmLists as $filmList): ?>
            <div class="film-cat">
                <p class="cat-subtitle"><a href="<?php echo Url::toRoute('/kinozal/categories/' . $filmList->slug)?>"><?php echo $filmList->name ?></a></p>
            <?php $films = $filmList->getFilms(); ?>
                <?php if (empty($films)) :?>
                    <p><?php echo $filmList->getErrorMessage() ?></p>        
                <?php else: ?>
                    <?php foreach ($films as $film): ?>
                    <div class="film-cat__slider">
<?php echo $this->render('film.info.php',[
    'film' => $film
])?>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>  
            <?php endforeach;?>
            
        <?php endif ;?>
    </div>
</div>

<?php
//dump($filmLists);

?>


