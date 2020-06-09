<?php
/* @var $this yii\web\View */
/* @var $form yii\widget\ActiveForm */
/* @var $model app\models\LoginForm */

    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
?>  
<?php 
    if( Yii::$app->session->hasFlash('auth-error') ) {
        $errorMessage = Yii::$app->session->getFlash('auth-error');
    } else {
        $errorMessage = '';
    }

?>
<!-- Вход -->
	<div class="modal fade" id="pop-register">
    	<div class="modal-dialog modal-sm">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
    			</div>
    			<div class="modal-body">
<?php 
    $form = ActiveForm::begin([
        'id' => 'register-form',
        'action' => ['/auth/register'],
        'options' => ['class' => 'enter-form']
    ]); ?>
    <p class="modal-title">Регистрация</p>
<?php
     echo ($form->field($model, 'login')->label(false)->textInput(['autofocus' => true,'placeholder' => 'E-mail']));
     echo ($form->field($model, 'password')->label(false)->passwordInput(['placeholder' => 'Пароль']));
     echo ($form->field($model, 'password_repeat')->label(false)->passwordInput(['placeholder' => 'Подтверждение пароля']));
?>

    <?= Html::submitButton('Вход', ['class' => 'enter-form__button', 'name' => 'acton']) ?>       


                            
<?php ActiveForm::end(); ?>
</div>    				

                    <p class="enter-form__rez"><?php echo $errorMessage ?></p>
    			</div>
    		</div>
    	</div> 



