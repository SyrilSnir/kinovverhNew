<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ActiveRecord\Media\AudioContent */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Аудиотреки', 'url' => ['audio']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-view">
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить аудиотрек?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Аудиотреки</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name:text:Имя файла',
                    'description:text:Описание',
                ],
            ]); ?>
        </div>
    </div>


</div>

