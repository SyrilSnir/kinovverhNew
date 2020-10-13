<?php 
/** @var \yii\web\View $this */
use app\widgets\Category\ShowPopularWidget;
$this->title = 'ДОБРО ПОЖАЛОВАТЬ В ОНЛАЙН КИНОЗАЛ КИНОКОМПАНИИ "ВВЕРХ"!';
?>
<section id="f-cat" class="f-cat-home">
    <div class="f-cat-bg"></div>
    <div class="container">
        <p class="h-title">Выберите категорию:</p>
        <div class="cat-buttons row">
            <div class="col-xs-3">
                <a href="/kinozal/categories/6plus" class="f-btton">6<span>+</span></a>
            </div>
                        <div class="col-xs-3">
                <a href="/kinozal/categories/12plus" class="f-btton">12<span>+</span></a>
            </div>
            <div class="col-xs-3">
                <a href="/kinozal/categories/16plus" class="f-btton">16<span>+</span></a>
            </div>
            <div class="f-btton-all col-xs-3">
                <a href="/kinozal/categories" class="f-btton f-btton__all">Все<span>фильмы</span></a>
            </div>
        </div>
    </div>
</section>
<div class = "container">
<?php 

echo ShowPopularWidget::widget();
?>
</div>