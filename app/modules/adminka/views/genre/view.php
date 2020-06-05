<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $genre app\models\ActiveRecord\Genre */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = $genre->name;
$this->params['breadcrumbs'][] = ['label' => 'Жанры', 'url' => ['genre']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genre-view">
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $genre->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $genre->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить страну?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Жанр</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $genre,
                'attributes' => [
                    'id',
                    'name:text:Название стрвны',
                    'code:text:Идентификатор',
                ],
            ]); ?>
        </div>
    </div>


</div>
