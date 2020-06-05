<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model use app\models\ActiveRecord\User */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['user']];
$this->params['breadcrumbs'][] = $this->title;
$adminList = Yii::$app->params['rootUsers'] ?? [];
?>
<div class="user-view">
    <?php if (!in_array($model->login, $adminList)): ?>
    <p>
        
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
 <?php  endif; ?>
    <div class="box">
        <div class="box-header with-border">Пользователь</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'login:text:Логин (E-mail)',
                    'fio:text:ФИО',
                    'birthday:text:Год рождения',
                ],
            ]); ?>
        </div>
    </div>


</div>

