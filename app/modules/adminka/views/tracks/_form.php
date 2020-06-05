<?php 
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;


/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Forms\Manage\Audio\TrackForm */
/* @var $albumId ?int */



?>
<div class="track-form">
<?php 
    $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]);
?>
    <div class="box box-default">
        <div class="box-body">  
        <?php echo $form->field($model, 'name')->textInput()?>
        <?php echo $form->field($model, 'track')->textInput()?>
        <?php echo $form->field($model, 'media')
                    ->dropDownList($model->mediaList())?>
        <?php if(!$albumId): ?>
        <?php echo $form->field($model, 'album')
                    ->dropDownList($model->albumsList())?>
        <?php else : ?>
        <?php echo $form->field($model, 'album')
                ->hiddenInput(['value' => $albumId]);  ?>
        <?php endif; ?>
        </div>            
    </div>
    
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>

