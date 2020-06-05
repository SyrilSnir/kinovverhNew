<?php
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ActiveRecord\Film\Film;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchModels\Films\FilmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\ActiveRecord\Film */

$this->title = 'Менеджер фильмов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="films-index">
    <p>
        <?php echo Html::a('Добавить фильм', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
        <div class="box">
            <div class="box-body">
                <?php echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id:integer:Id',
                        [
                            'label' => 'Изображение',
                            'value' => function (Film $model) {
                                return Html::img($model->anonsImage,['style' => 'width: 80px']);
                            },
                            'format' => 'raw',
                            'contentOptions' => ['style' => 'width: 100px'],
                        ],
                        'name:text:Фильм',
                        [
                            'attribute' => 'country_id',
                            'label' => 'Страна',
                            'filter' => $searchModel->countriesList(),
                            'value' => 'country.name'
                        ],
                        [
                            'label' => 'Анонс',
                            'value' => 'preview_text',
                            'contentOptions' => ['style' => 'width: 400px'],
                        ],                       
                        [
                          'class' => ActionColumn::class,
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
</div>

