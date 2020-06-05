<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Forms\Manage\User\UserForm */

$this->title = 'Редактирование пользователя';
?>

<div class="user-update">
    <div class="user-edit-form">
    <?php 
        $form = ActiveForm::begin([
            'options' => ['enctype'=>'multipart/form-data']
        ]);
    ?>
        <div class="box box-default">
            <div class="box-body">  
             <?php echo $form->field($model, 'login')->textInput()?>
             <?php echo $form->field($model, 'fio')->textInput()?>
             <?php echo $form->field($model, 'birthday')->textInput()?>
            </div>

        </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>
