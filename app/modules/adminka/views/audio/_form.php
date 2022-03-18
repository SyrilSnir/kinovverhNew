<?php

use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use app\models\Forms\Media\AudioMaterialForm;

/* @var $form ActiveForm */
/* @var $model AudioMaterialForm */

?>
<div class="audiofile-form">
<?php 
    $fileSelectParameters = [
            'data' => $model->getFilesList()
        ];
    if ($model->file) {
        $fileSelectParameters['value'] = $model->file;
    }
    
    $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]);
?>
    <div class="box box-default">
        <div class="box-body">  
<?php 

echo $form->field($model, 'description')->textInput();        
echo $form->field($model, 'file')->widget(Select2::class, $fileSelectParameters);
?>

        </div>
            
    </div>
    
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>

