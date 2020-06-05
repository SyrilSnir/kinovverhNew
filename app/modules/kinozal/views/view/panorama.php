<?php
/** @var \yii\web\View $this */
/** @var app\models\ActiveRecord\Film $film */
$this->title = "Обзор фильма - " . $film->name;
?>
<div class="films-tabs__content tab-content">
    <div id="tab1" class="tab-pane active" role="tabpanel">
        <div class="row">
            <div class="col-md-3 hidden-mobile">
                <div class="film-tabs__img">                    
                    <img src="<?php echo $film->anonsImage ?>" class="img-responsive" alt="Image">
                </div>
            </div>
<?php echo $this->render('../blocks/film.info.php',[
    'introText' => $film->detail_text ?? $film->preview_text,
    'film' => $film 
])?>
            </div> 
        </div>
    </div>

