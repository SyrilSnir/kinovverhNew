<?php
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchModels\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менеджер персон';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <p>
        <?= Html::a('Новая персона', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id:integer:Id',
                    'name:text:ФИО',
                    'year:text:Год рождения',
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>