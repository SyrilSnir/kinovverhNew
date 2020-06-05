<?php
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Blog\GenreSearch */
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
            <?php Pjax::begin() ?>
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
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
