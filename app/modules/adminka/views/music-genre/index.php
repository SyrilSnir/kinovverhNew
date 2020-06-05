<?php
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchModels\Audio\GenreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менеджер жанров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genre-index">

    <p>
        <?= Html::a('Новый жанр', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id:integer:Id',
                    'name:text:Жанр',
                    'code:text:Идентификатор',
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>
