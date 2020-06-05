<?php
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchModels\Media\AudioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Аудиоматериалы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audio-index">

    <p>
        <?= Html::a('Новый аудиоматериал', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id:integer:Id',
                    'name:text:Имя файла',
                    'description:text:Описание',                
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>



