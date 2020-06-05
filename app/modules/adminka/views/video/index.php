<?php
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchModels\Media\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Видеоматериалы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <p>
        <?= Html::a('Новый видеоматериал', ['create'], ['class' => 'btn btn-success']) ?>
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

