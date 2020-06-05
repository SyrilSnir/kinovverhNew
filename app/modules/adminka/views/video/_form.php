<?php 
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use kartik\file\FileInput;

/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Forms\Media\VideoFileForm */


$videoFilePluginOptions = [
            'previewFileType' => 'video',
            'showRemove' => false,
            'initialPreviewFileType'=> 'video',
            'initialPreviewConfig'=> [
                ['filetype'=> "video/mp4"]
            ],
            'validateInitialCount' => true,
            'initialPreviewAsData' => true,
            'allowedFileExtensions' => ['mp4'],
            'showUpload' => true
    ];
if ($model->videoFileUrl) {
    $videoFilePluginOptions = array_merge($videoFilePluginOptions, [
        'initialPreview'=>[
             $model->videoFileUrl
        ],
        'initialPreviewAsData'=>true,
    ]);
}
?>
<div class="videofile-form">
<?php 
    $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]);
?>
    <div class="box box-default">
        <div class="box-body">  
         <?php echo $form->field($model, 'description')->textInput()?>
         <?php echo $form->field($model, 'file')->widget(FileInput::classname(), [
                        'options' => ['accept' => '/video/*', 'multiple' => false],
                        'pluginOptions' =>  $videoFilePluginOptions
                    ]);
         ?>

        </div>
            
    </div>
    
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>

