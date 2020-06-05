<?php 
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use kartik\file\FileInput;
use dosamigos\multiselect\MultiSelectListBox;

/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Forms\Manage\Audio\AlbumForm */

if (!$model->imageFile) {
    $pluginOptions = [];
} else {
    $pluginOptions = [
        'showRemove' => false,
        'initialPreview'=>[
             $model->imageFile
        ],
        'initialPreviewAsData'=>true,
    ];
}

?>
<div class="album-form">
<?php 
    $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]);
?>
    <div class="box box-default">
        <div class="box-body">  
         <?php echo $form->field($model, 'name')->textInput()?>
         <?php echo $form->field($model, 'code')->textInput()?>
         <?php echo $form->field($model, 'description')->textInput()?>
         <?php echo $form->field($model, 'year')->textInput()?>
         <?php  echo $form->field($model, 'genreList')->widget(MultiSelectListBox::className(),[
            'data' => $model->getGenres(),
            'options' => [
                'multiple'=>"multiple"
            ],
            'clientOptions' => [
            ]
        ])  ?> 
         <?php echo $form->field($model, 'imageFile')->widget(FileInput::class, 
                        [
                            'options' => [
                                'accept' => 'image/*',
                                'multiple' => false
                            ],
                            'pluginOptions' => $pluginOptions
                        ])
                    ?>
            
 
        </div>
            
    </div>
    
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>

