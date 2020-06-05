<?php
use yii\bootstrap\Html;
use yii\widgets\DetailView;
use app\core\helpers\Films\CommentHelper;

/* @var $this yii\web\View */
/* @var $comment app\models\ActiveRecord\FilmComment */

$this->title = 'Комментарий';
$this->params['breadcrumbs'][] = ['label' => 'Комментарии', 'url' => ['comments']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="comment-view">
    <p>
        <?php if ($comment->isPublished()): ?>
            <?php echo Html::a('Снять с публикации', ['unpublish', 'id' => $comment->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?php echo Html::a('Опубликовать', ['publish', 'id' => $comment->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?php echo Html::a('Изменить', ['update', 'id' => $comment->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Удалить', ['delete', 'id' => $comment->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить комментарий?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Страна</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $comment,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'film_id',
                        'label' => 'Фильм',
                        'value' => $comment->film->name
                    ],
                    'user_name:text:Автор',
                    'message:text:Текст комментария',
                    [
                        'attribute' => 'moderate',
                        'label' => 'Статус',
                        'value' => CommentHelper::getStatusLabel($comment->moderate),
                        'format' => 'raw'
                    ]
                ],
            ]); ?>
        </div>
    </div>


</div>


