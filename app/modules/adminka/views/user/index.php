<?php
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchModels\User\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление пользователями';
$this->params['breadcrumbs'][] = $this->title;
$adminList = Yii::$app->params['rootUsers'] ?? [];
?>
<div class="user-index">
<?php 

// Добавление нового пользователя из панели администратора не имеет смысла
/* ?>
    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php */ ?>
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [                    
                    'id:integer:Id',
                    'login:text:Логин (E-mail)',
                    'fio:text:ФИО',
                    'birthday:text:Год рождения',
                    [ 
                        'class' => ActionColumn::class,
                         'visibleButtons' => [
                            'update' => function ($model)  use ($adminList) {
                                return !in_array($model->login, $adminList );
                            },
                            'delete' => function ($model)  use ($adminList) {
                                return !in_array($model->login, $adminList );
                            }
                        ]                    
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
