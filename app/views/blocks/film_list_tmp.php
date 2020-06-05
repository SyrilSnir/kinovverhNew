
<?php
use app\core\AppConfig;

/* @var $filmLists app\core\repositories\Films\FilmList[] */
/* @var $this yii\web\View */
?>
<p class="cat-title hidden-mobile">Фильмы</p>
<?php
foreach ($filmLists as $filmsList) {
    if (empty($films = $filmsList->getFilms())): ?>
        <p class="h-title"><?php echo $filmsList->getName()?></p>
        <p><?php echo $filmsList->getErrorMessage() ?></p>
<?php else : ?>
<section id="f-pop" class="f-pop-home">
    <p class="h-title"><?php echo $filmsList->getName()?></p>
    <div class="row">
<?php
    foreach ($films as $film ) {
        if (!empty($film['images'])) {
            $filmObjectImage = json_decode($film['images']);
            $filmAnonsImage = $filmObjectImage->anons_image ? 
                    $filmObjectImage->anons_image : 'no-image.jpg';
        } else {
            $filmAnonsImage = 'no-image.jpg';
        }
?>
    <div class="pop-film col-md-2">
        <div class="pop-film__wrapp" data-id="<?php echo $film->id ?>"> 
            <a class="pop-film__play" href="/kinozal/<?php echo $film->code ?>"></a>
            <span class="pop-film__vozr"><?php echo $film->category->name ?></span>
            <div class="pop-film__data hidden-mobile">
                <div class="pop-film__arrow"></div>
                    <div class="pop-film__data-wrap">
                    <p>
                        <a href="/kinozal/<?php echo $film->code ?>" class="btn btn-xs">Смотреть</a>
                        <a href="#pop-enter" class="btn btn-xs" data-toggle="modal" data-id="<?php echo $film->id ?>">Смотреть позже</a>
                    </p>
                    <p><span>Год выпуска:</span> <?php echo $film->year ?></p>
                    <?php if (count($film->editors) > 0): ?>
                        <?php if (count($film->editors) === 1): ?>                    
                            <p><span>Режиссер:</span> <?php echo $film->editors[0]->name?></p>
                        <?php else: ?>
                        <?php
                            $editors = '';
                            foreach ($film->editors as $editor) {
                                $editors.= ' '.$editor->name . ',';
                            }
                            $editors = trim($editors,',');
                        ?>
                            <p><span>Режиссеры:</span><?php echo $editors ?></p>
                        <?php endif;?>
                    <?php endif;?>
                    <?php if (count($film->actors) > 0): ?>
                        <?php
                            $actors = '';
                            foreach ($film->actors as $actor) {
                                $actors.= ' '.$actor->name . ',';
                            }
                            $actors = trim($actors,',');
                        ?>
                             <p><span>В ролях:</span> <?php echo $actors ?></p>
                    <?php endif;?>                   
                    </div>
			</div>
            <a href="/kinozal/<?php echo $film->code ?>"><img src="<?php echo AppConfig::FILM_IMG_URI . $filmAnonsImage ?>" class="img-rounded" /></a>
			<div class="pop_film__caption">
				<h3><?php echo $film->name ?></h3>
				<p>(<?php echo $film->year ?>)</p>
			</div>
        </div>
    </div>
            
<?php
    }
?>
    </div>
</section>    
<?php
endif;
}
?>

