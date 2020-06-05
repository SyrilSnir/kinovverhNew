<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $album app\models\ActiveRecord\Audio\Album */
/* @var $tracksProvider yii\data\ActiveDataProvider */

$this->title = $album->name;
$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['albums']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view">
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $album->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $album->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить альбом?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Страна</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $album,
                'attributes' => [
                    'id',
                    'name:text:Название альбомв',
                    'code:text:Идентификатор',
                    'description:text:Описание',
                    'year:text:Год издания',
                ],
            ]); ?>
        </div>
            <?php if ($album->image_url) :?>
    <div class="box">
        <div class="box-header with-border">Изображение альбома</div>
        <div class="box-body">

                <?php echo Html::img($album->image_url, [
                    'class' => 'thumbnail',
                ]) ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="box">
        <div class="box-header with-border">Список треков</div>
        <?= Html::a('Добавить новый трек в альбом', [ '/adminka/tracks/add-to-album','id' => $album->id ], ['class' => 'btn btn-success']) ?>
    <?= GridView::widget([
        'dataProvider' => $tracksProvider,
        'layout' => "{items}\n{pager}",
        'columns' => [
            'track_num:text:Номер трека',
            'name:text:Название',
        ],
    ]); ?>           
    </div>
</div>


</div>
