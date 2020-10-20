<?php

use app\core\helpers\View\ActivateHelper;
use app\models\ActiveRecord\Widget\CarouselWidgetElement;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model CarouselWidgetElement */
/* @var $modificationsProvider ActiveDataProvider */

$this->title = $model->name;
?>
<div class="city-view">
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите элемет?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Вернуться', ['index'], ['class' => 'btn btn-default']) ?>
    </p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo $this->title ?></h3>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name:text:Заголовок',
                    'film.name:text:Фильм'
                ],
            ]); ?>
        <div class="box">
            <div class="box-header with-border">Изображение для карусели</div>
            <div class="box-body">
                    <?php echo Html::img($model->getUploadedFileUrl('image'), [
                        'class' => 'thumbnail',
                    ]) ?>
            </div>
        </div>
         
        </div>
    </div>
</div>

