<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $country app\models\ActiveRecord\Country */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = $country->name;
$this->params['breadcrumbs'][] = ['label' => 'Страны', 'url' => ['country']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-view">
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $country->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $country->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить страну?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Страна</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $country,
                'attributes' => [
                    'id',
                    'name:text:Название стрвны',
                    'code:text:Идентификатор',
                ],
            ]); ?>
        </div>
    </div>


</div>
