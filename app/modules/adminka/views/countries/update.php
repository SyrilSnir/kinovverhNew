<?php

/* @var $this yii\web\View */
/* @var $model  app\models\Forms\Manage\User\Geografy\CountryForm */
/* @var $country app\models\ActiveRecord\Geografy\Country */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Редактировать страны: ' . $country->id;
$this->params['breadcrumbs'][] = ['label' => 'Country', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $country->id, 'url' => ['view', 'id' => $country->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'code')->textInput(['maxLength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
