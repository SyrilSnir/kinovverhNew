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
            'class' => 'film-tabs--nav nav nav-tabs',
            'id' => 'lk-menu'
        ],
        'itemOptions' => [
            'role' => 'presentation',
            'class' => 'lk-menu-item'
        ]
    ]);
    ?>
    </div>
    <div class="films-tabs__content tab-content">
<?php echo $this->render('tabs/home',[
    'user' => $user
]);?>
<?php echo $this->render('tabs/favorites');?>
<?php echo $this->render('tabs/buy');?>
    </div>
</section>

