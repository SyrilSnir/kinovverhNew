<?php


use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $film app\models\ActiveRecord\Film */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = $film->name;
$this->params['breadcrumbs'][] = ['label' => 'Фильмы', 'url' => ['films']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-view">
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $film->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $film->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить фильм?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Фильм</div>
        <div class="box-body">
            <?php echo DetailView::widget([
                'model' => $film,
                'attributes' => [
                    'id',
                    'name:text:Название фильма',
                    'code:text:Идентификатор',
                    'category.name:text:Категория информационной продукции',
                    'country.name:text:Страна',
                    'year:text:Год выхода',
                    'time:text:Продолжительность (мин.)',
                    'rating:text:Рейтинг'
                ],
            ]); ?>
        </div>
    </div>
    <?php if ($film->hasAnonsImage()) :?>
    <div class="box">
        <div class="box-header with-border">Изображение для анонса</div>
        <div class="box-body">

                <?php echo Html::img($film->getAnonsImage(), [
                    'class' => 'thumbnail',
                ]) ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if ($film->hasDetailImage()) : ?>
    <div class="box">
        <div class="box-header with-border">Детальное изображение</div>
        <div class="box-body">

                <?php echo Html::img($film->getDetailImage(), [
                    'class' => 'thumbnail',
                ]) ?>
        </div>
    </div>
    <?php endif; ?>


</div>