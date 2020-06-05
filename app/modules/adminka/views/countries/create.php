<?php

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\Geografy\CountryForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Новая страна';
$this->params['breadcrumbs'][] = ['label' => 'Country', 'url' => ['country']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'code')->textInput(['maxLength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

