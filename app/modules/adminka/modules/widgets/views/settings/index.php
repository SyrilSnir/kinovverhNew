<?php

use app\core\helpers\View\ActivateHelper;
use app\models\ActiveRecord\Widget\WidgetsList;
use app\models\SearchModels\Widgets\WidgetSearch;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel WidgetSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Управление виджетами';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Новый виджет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id:integer:Id',
                    'name:text:Название виджета',
                    [
                        'attribute' => 'activate',
                        'label' => 'Статус',
                        'format' => 'raw',
                        'filter' => ActivateHelper::statusList(),
                        'value' => function (WidgetsList $model) {
                            return ActivateHelper::statusLabel($model->activate);
                        }                        
                    ],
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>

