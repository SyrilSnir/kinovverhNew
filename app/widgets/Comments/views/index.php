<?php 
/* @var $film app\models\ActiveRecord\Films */
/* @var $commentForm app\models\Forms\CommentForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
//use Yii;
?>
<div class="film-commens">
    <div class="reviews-reply-form">
        <p class="film-commens__title"><?php echo Html::encode('Комментарии к фильму '.$film->name) ?> <span>(<?php echo count($film->availableComments) ?>)</span></p>
   
<?php 
$form = ActiveForm::begin([
    'id' => 'replier',
    'action' => ['comments/save-comment'],
    'options' => [ 'class' => 'reviews-form film-commens__form']
]);
echo $form->field($commentForm,'filmSlug')->label(false)->hiddenInput();
echo $form->field($commentForm,'filmId')->label(false)->hiddenInput();
?>   
        
<?php if (Yii::$app->user->isGuest):?>
<?php 
echo $form->field($commentForm, 'userName',[
    'template' => '<div class="reviews-reply-field reviews-reply-field-author">{label}<span>{input}</span></div>'
])->textInput(); 
?>        
<?php endif ;?>
<?php 
echo $form->field($commentForm, 'message',[
    'template' => '<div class="reviews-reply-field reviews-reply-field-text"><div class="lha-source-div">{input}</div></div>'
])->label(null)
  ->textarea(['class' => 'lha-textarea', 'rows' => 25,'style' => 'font-family: Helvetica, Verdana, Arial, sans-serif; font-size: 16px; height: 170px; width: 798px;']);
?>        
<?php echo Html::submitButton('Оставить отзыв', 
        [ 'class' => 'caption-btn__btn pull-right',
            'name' => 'send_button']) ?>
        
<?php ActiveForm::end(); ?>
    </div>
    <ul class="film-commens__list">
<?php foreach ($film->availableComments as $comment):?>
	<li class="film-comment">
		<p class="film-comment__title">
			<span class="comment__name"><?php echo $comment->user_name ?></span>
			<span class="comment__data">
                            <i class="fa fa-calendar" aria-hidden="true"></i><?php echo ((new DateTime($comment->updated_at))->format('d-m-Y')); ?></span>
		</p>
		<p class="film-comment__content"><?php echo $comment->message ?></p>
				<div class="reviews-post-reply-buttons">

		</div>
	</li>
        <?php endforeach; ?>

		</ul>
</div>

