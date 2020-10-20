<?php

use app\models\ActiveRecord\Widget\CarouselWidgetElement;
use app\widgets\MainPageCarousel\Assets\CarouselWidgetAsset;
use yii\web\View;

/** @var View $this */
/** @var CarouselWidgetElement[] $carouselItems */
CarouselWidgetAsset::register($this);

?>

<div class="top-slider">
    <div class="carousel-inner owl-carousel owl-theme">
        <?php foreach ($carouselItems as $carouselItem): ?>
        <div class="carousel-item">
            <img src="<?php echo $carouselItem->getUploadedFileUrl('image')?>" alt="<?php echo $carouselItem->name ?>" class="img-responsive">
            <?php if ($carouselItem->film):?>
            <div class="container">
                <div class="carousel-caption">
                    <div class="col-md-offset-6">
                        <div class="caption-btn">
                            <a class="caption-btn__btn " href="<?php echo $carouselItem->film->url ?>" role="button">Смотреть онлайн</a>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
            <?php endif;?>
        </div>
        <?php endforeach; ?>
    </div>
</div>
