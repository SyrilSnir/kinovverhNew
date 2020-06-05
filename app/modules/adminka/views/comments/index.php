<?php
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use app\core\helpers\Films\CommentHelper;
use app\models\ActiveRecord\Film\FilmComment;

/* @var $this yii\web\View */
/* @var $searchModel  app\models\SearchModels\Films\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\ActiveRecord\FilmComment */

$this->title = 'Менеджер комментариев';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Новый комментарий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id:integer:Id',
                    'created_at:datetime:Дата создания',
                    [
                        'attribute' => 'film_id',
                        'label' => 'Фильм',
                       'filter' => $searchModel->filmsList(),
                        'value' => 'film.name'
                    ],
                    'user_name:text:Автор',
                    'message:text:Текст', 
                    [
                        'attribute' => 'moderate',
                        'label' => 'Статус',
                        'format' => 'raw',
                        'filter' => $searchModel->statusList(),
                        'value' => function (FilmComment $model) {
                            return CommentHelper::getStatusLabel($model->moderate);
                        }
                    ],
                    [
                        'class' => ActionColumn::class,
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

