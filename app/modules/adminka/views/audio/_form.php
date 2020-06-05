<?php 
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use kartik\file\FileInput;

/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Forms\Media\AudioFileForm */


$audioFilePluginOptions = [
            'previewFileType' => 'audio',
            'showRemove' => false,
            'initialPreviewFileType'=> 'audio',
            'initialPreviewConfig'=> [
                ['filetype'=> "audio/mp3"]
            ],
            'validateInitialCount' => true,
            'initialPreviewAsData' => true,
            'allowedFileExtensions' => ['mp3'],
            'showUpload' => true
    ];
if ($model->audioFileUrl) {
    $audioFilePluginOptions = array_merge($audioFilePluginOptions, [
        'initialPreview'=>[
             $model->audioFileUrl
        ],
        'initialPreviewAsData'=>true,
    ]);
}
?>
<div class="audiofile-form">
<?php 
    $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]);
?>
    <div class="box box-default">
        <div class="box-body">  
         <?php echo $form->field($model, 'description')->textInput()?>
         <?php echo $form->field($model, 'file')->widget(FileInput::classname(), [
                        'options' => ['accept' => '/audio/*', 'multiple' => false],
                        'pluginOptions' =>  $audioFilePluginOptions
                    ]);
         ?>

        </div>
            
    </div>
    
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>

