<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="modal fade" id="pop-pay-add">
    <div class="modal-dialog modal-smm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <p class="modal-title">Пополнить счет</p>
                <p class="pay-description2">Укажите сумму, на которую хотите пополнить свой личный счет:</p>                
            </div>
            <?php $form = ActiveForm::begin([
                'action' => 'pay'
            ]); ?>
            <?php echo $form->field($model, 'summa')->textInput([
                'class' => 'pay-summ'
            ])->label(false) ?>
            <?php echo Html::submitButton('Пополнить', ['class' => 'pop-button']) ?>
                <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
