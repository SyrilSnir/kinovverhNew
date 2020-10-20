<?php

use app\models\Forms\Manage\Widgets\CarouselElementForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $form ActiveForm */
/* @var $model CarouselElementForm */

if (!$model->image) {
    $pluginOptions = [];
} else {
    $pluginOptions = [
        'showRemove' => false,
        'initialPreview'=>[
            $model->imageUrl
        ],
        'initialPreviewAsData'=>true,
    ];
}
?>
<div class="genre-edit-form">
<?php 
    $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]);
?>
    <div class="box box-default">
        <div class="box-body">  
<?php 

echo $form->field($model, 'name')->textInput();
echo $form->field($model, 'filmId')->widget(Select2::class,[
             'data' => $model->filmsListWithNotSelected()
         ] );
echo $form->field($model, 'image')->widget(FileInput::class, 
        [
            'options' => [
                'accept' => 'image/*',
                'multiple' => false
            ],
            'pluginOptions' => $pluginOptions
        ]);                 
                 
?>                       
        </div>
            
    </div>    
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>