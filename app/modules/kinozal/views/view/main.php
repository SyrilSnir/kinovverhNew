<?php 
/* @var $this yii\web\View */
/* @var $view string */
/* @var $film app\models\ActiveRecord\Film */
/* @var $menu array */
/* @var $options array */
use yii\widgets\Menu;
?>
<?php
    if ($options['top_block']) {
        echo $this->render('../blocks/' . $options['top_block']['viewFile'],[
            'film' => $film
        ]);
    }
?>
<section class="section-2">
    <div class="container">
        <p class="film-title"><?php echo $film->name ?></p>
        <div class="film-tabs" role="tabpanel">
            <div class="film-tabs__wrapper">
            <?php
            echo Menu::widget([
                'items' => $menu,
                    'options' => [
                        'role' => 'tablist',
                        'class' => 'film-tabs--nav nav nav-tabs'
                    ],
                    'itemOptions' => [
                        'role' => 'presentation'
                    ]
                ]); ?>
            </div>
<?php
echo $this->render($view,[
    'film' => $film,
    'options' => $options
]);
?>
        </div>
    </div>
</section>


