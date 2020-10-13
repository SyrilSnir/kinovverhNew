<?php 

use app\widgets\Auth\LoginFormWidget;
use app\widgets\Auth\RegisterFormWidget;
use yii\helpers\Html;
use app\assets\YiiAsset;
use app\assets\MainAsset;
use app\core\helpers\Menu\NavMenuHelper;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

YiiAsset::register($this);
MainAsset::register($this);
$this->beginPage();

$loginFormModel = null;
$registerFormModel = null;


$menu = NavMenuHelper::getMenu();
?>
<!DOCTYPE html>
<html lang="<?php echo \Yii::$app->language?>">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
        <meta name="robots" content="index, follow" />
        <meta name='viewport' content='width=1170' />
        <?= Html::csrfMetaTags() ?>
         <?php $this->head(); ?>
        <title><?= Html::encode($this->title) ?></title>
    </head>
    <body>
<?php $this->beginBody(); ?>
<?php
    if (Yii::$app->user->isGuest) {
        $user = false;
        $loginFormModel = isset($this->params['showLoginForm']) ? $this->params['LoginFormModel'] : null;
        $registerFormModel = isset($this->params['showRegisterForm']) ? $this->params['RegisterFormModel'] : null;
    } else {
        $user = Yii::$app->user->getIdentity();
    }
?>
<header>
    <div class="container">
        <div class="row">
            <?php
                NavBar::begin([
                    'brandLabel' => 'Кинофорум ВВЕРХ',
                    'brandUrl' => Yii::$app->homeUrl,
                    'brandImage' => '/img/logo.png',
                    'options' => [
                        'class' => 'navbar navbar-inverse',                        
                    ],
                    'brandOptions' => [
                        'class' => 'logo'
                    ],
                    'innerContainerOptions' => [
                        'class' => 'container-fluid'
                    ]
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'nav navbar-nav'],
                    'items' => $menu
                ]);
                ?>
            
                                        <span class="nav-bl3 navbar-left hidden-xs">		  					
                                <form class="navbar-form navbar-left" action="/search/" role="search">
                                    <div class="form-group">
                                        <input type="text" name="q" class="form-control" placeholder="Поиск" /><i class="fa fa-search"></i>
                                    </div>
                                </form>
                                <?php if (!$user): ?>
                                <a id="show-login-form" class="btn btn-default btn-xs" href="#pop-enter" data-toggle="modal">Войти <i class="fa fa-user"></i></a>
                                <?php else: ?>
                                <ul class="user">
                                    <li><a class="btn btn-default btn-xs" href="/lk"><?php echo $user->getName() ?><i class="fa fa-user"></i></a>
                                        <ul>
                                            <li>
                                                <?php   
                                                   echo Html::a('Выйти',['/auth/logout'],['class' => 'user__out']);
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <?php endif; ?>
                            </span>
            <?php
                NavBar::end();
                ?>

        </div>
    </div>    
</header>
<div class="navbar-bg-right"></div>   
<?php 
    
?>
        <div class="page-content">
<?php echo $content ?>
        </div>
    <footer>
        <div class="container">
            <div class="col-md-12">
                <p class="copyright text-center">© Кинозал семейного кино КИНОКОМПАНИИ «ВВЕРХ» 2016-<?php echo date('Y')?></p>
            </div>
        </div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter44880781 = new Ya.Metrika({
                    id:44880781,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/40318850" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->  

    </footer>
<?php if (!$user): ?>
    
<?php 
    echo LoginFormWidget::widget(['model' => $loginFormModel]);
    echo RegisterFormWidget::widget(['model' => $registerFormModel]);
?>
<?php endif; ?>
<?php $this->endBody() ?> 
    <?php
    if (isset($this->params['showLoginForm'])) : ?>
    <script>
    $(function(){
        console.log('Показать форму входа');
        $('#show-login-form').trigger('click');
    });
    </script>
    <?php endif ;?>
    <?php
    if (isset($this->params['showRegisterForm'])) : ?>
    <script>
    $(function(){
        console.log('Показать форму регистрации');
        $('#register-form-submit').trigger('click');
    });
    </script>
    <?php endif ;?>
    </body>
    
</html>
<?php $this->endPage() ?>

