<?php

use yii\helpers\Url;
use app\widgets\Comments\CommentsWidget;
use yii\web\View;

/* @var $film app\models\ActiveRecord\Film\Film */
/* @var $this View */
/* @var $showFilm boolean */
/* @var $options array */

$showFilm = (bool) $options['showFilm'] ?? false;
if (!$showFilm) {
    $this->title = 'Информация о фильме - ' . $film->name;
}
?>
<div class="films-tabs__content tab-content">
    <div id="tab1" class="tab-pane active" role="tabpanel">
        <div class="row">
            <div class="col-md-3 hidden-mobile">
                <div class="film-tabs__img">                    
                    <img src="<?php echo $film->anonsImage ?>" class="img-responsive" alt="Image">
                </div>
            </div>
<div class="film-tabs__description col-md-9">            
<?php echo $this->render('../blocks/film.info.php',[
    'introText' => $film->preview_text,
    'film' => $film 
])?>
    <p class="caption-btn">
        <?php if(!$showFilm):?>
        <a class="caption-btn__btn" href="<?php echo $film->url ?>">Смотреть онлайн</a>  
        <?php endif; ?>
    </p>

                <?php echo CommentsWidget::widget(['film' => $film]) ?>
            </div> 
        </div>
    </div>
</div>

