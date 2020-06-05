<?php

/** @var yii\web\View $this */

use yii\widgets\Menu;
use app\assets\MainAsset;
use app\core\helpers\Menu\LkMenuHelper;

$this->registerJsFile('@web/build/lk.js',[
    'depends' => MainAsset::class
]);
$this->title = 'Личный кабинет';
$user = Yii::$app->user->getIdentity();
$lkMenu = LkMenuHelper::getMenu();

?>
<section class="section-lk container">
    <h1 class="section-lk__title">Личный кабинет</h1>
    <div class="film-tabs__wrapper">
    <?php 
    echo Menu::widget([
        'items' => $lkMenu,
        'options' => [
            'role' => 'tablist',
            'class' => 'film-tabs--nav nav nav-tabs'
        ],
        'itemOptions' => [
            'role' => 'presentation'
        ]
    ]);
    ?>
    </div>
    <div class="films-tabs__content tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <form action="" method="POST" role="form" class="lk-form form-horizontal col-md-10"> 
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label"><i class="glyphicon glyphicon-envelope"></i> E-mail</label>
                    <div class="col-xs-9">
                        <div id="lk-form__mail">
                            <div class="input-group">
                                <input name="EMAIL" disabled="disabled" value="<?=$user->login ?>" class="form-control col-xs-10" placeholder="Указать E-mail" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label"><i class="glyphicon glyphicon-user"></i> Ваше имя</label>
                    <div class="col-xs-9">
                        <div id="lk-form__name">
                            <div class="input-group">
                                <input name="fio" disabled="disabled" value="<?=$user->fio ?>" data-default="Алексей" class="form-control" placeholder="Указать имя" type="text">
                                <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                </div>
                            </div>
                        </div>	
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-xs-3 control-label"><i class="fa fa-key" aria-hidden="true"></i> Пароль</label>
                    <div class="col-xs-9">

                            <div id="lk-form__pass">
                                    <div class="input-group">
                                    <input name="PASSWORD" value="***************" class="form-control col-xs-10" disabled="disabled" placeholder="Указать Пароль" type="password">
                                    <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                    </div>
                                                                    </div>
                                                            </div>
                    </div>
                </div>                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label"><i class="glyphicon glyphicon-calendar"></i> Дата рождения</label>
                    <div class="col-xs-9">
                            <div id="lk-form__year">
                                    <div class="input-group collapse" id="lk-form__year">
                                        <input class="form-control col-xs-10 datepicker" name="birthday" disabled="disabled" data-default="13.06.2000" placeholder="Указать Дату рождения" value="<?= $user->birthday ?>" type="text">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

