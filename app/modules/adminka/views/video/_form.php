<?php

use app\models\Forms\Media\VideoFileForm;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $form ActiveForm */
/* @var $model VideoFileForm */

?>
<div class="videofile-form">
<?php 
    $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]);
?>
    <div class="box box-default">
        <div class="box-body">  
<?php 

echo $form->field($model, 'description')->textInput();        
echo $form->field($model, 'file')->widget(Select2::class, 
        [
            'data' => $model->getFilesList()
        ]);
?>

        </div>
            
    </div>
    
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>

