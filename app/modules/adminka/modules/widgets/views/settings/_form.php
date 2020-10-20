<?php

use kartik\switchinput\SwitchInput;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $form ActiveForm */
/* @var $model app\models\Forms\Manage\Films\Genre */
?>
<div class="genre-edit-form">
<?php 
    $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]);
?>
    <div class="box box-default">
        <div class="box-body">  
         <?php echo $form->field($model, 'name')->textInput()?>
         <?php echo $form->field($model, 'className')->textInput()?>
            
        <?= $form->field($model, 'status')->widget(SwitchInput::class,[
                'pluginOptions' => [
                        'onText' => 'Вкл',
                        'offText' => 'Выкл',
                    ]
            ]) 
        ?>            
        </div>
            
    </div>
    
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>