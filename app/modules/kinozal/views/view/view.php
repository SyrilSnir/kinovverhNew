<?php


/* @var $film app\models\ActiveRecord\Film\Film */
/* @var $this yii\web\View */
/* @var $options array */
$this->title = "Смотреть фильм - " . $film->name;

echo $this->render('index',[
    'film' => $film,
    'options' => $options
]);

