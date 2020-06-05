<?php
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchModels\Geografy\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менеджер стран';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Новая страна', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id:integer:Id',
                    'name:text:Название страны',
                    'code:text:Идентификатор',
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>

