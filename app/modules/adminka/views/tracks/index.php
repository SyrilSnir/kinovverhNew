<?php
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchModels\Audio\TrackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Треки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="track-index">

    <p>
        <?= Html::a('Новый трек', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id:integer:Id',
                    'name:text:Название трека',
                    'time:text:Продолжительность',
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>



