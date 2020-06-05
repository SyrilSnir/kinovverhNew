<?php
/* @var $this yii\web\View */
use app\widgets\Comments\CommentsWidget;
?>
<?php if( Yii::$app->session->hasFlash('comment_saved') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('comment_saved'); ?>
    </div>
<?php endif;?>

<div class="films-tabs__content tab-content">
    <div role="tabpanel" class="tab-pane active" id="tab3">
        <div class="col-md-9">
<?php
echo CommentsWidget::widget(['film' => $film]) ;

?>
        </div>
<?php
//echo $this->render('_viewblock',['film' => $model]);
?>
    </div>
</div>