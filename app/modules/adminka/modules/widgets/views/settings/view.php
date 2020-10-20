<?php

use app\core\helpers\View\ActivateHelper;
use app\models\ActiveRecord\Widget\WidgetsList;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model WidgetsList */
/* @var $modificationsProvider ActiveDataProvider */

$this->title = $model->name;
?>
<div class="city-view">
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите виджет?',
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
                    'name:text:Название виджета',
                    'class_name:text:Класс виджета',
                    [
                       'attribute'  => 'activate',
                       'label' => 'Статус',
                       'value' => ActivateHelper::statusLabel($model->activate),
                       'format' => 'raw'
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

