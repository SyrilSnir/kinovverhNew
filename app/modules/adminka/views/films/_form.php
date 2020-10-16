<?php 
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use mihaildev\ckeditor\CKEditor;
use kartik\file\FileInput;
use app\models\ActiveRecord\Media\Gallery;
use app\models\ActiveRecord\Media\Trailers;
use dosamigos\multiselect\MultiSelectListBox;


/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Forms\Manage\Films\FilmForm */
/* @var $update bool */
/* @var $filmId int */
/* @var $personList array */
 /** @var Gallery[] $galleryImageList */
 /** @var Trailers[] $trailersVideoList */
$pluginAnonsImageOptions = [];
$pluginDetailImageOptions = [];
if ($update) {
    if ($model->anonsImage) {
        $pluginAnonsImageOptions = [
            'showRemove' => false,
            'initialPreview'=>[
                 $model->anonsImage
            ],
            'initialPreviewAsData'=>true,
        ];
    }
    if ($model->detailImage) {
        $pluginDetailImageOptions = [
            'showRemove' => false,
            'initialPreview'=>[
                 $model->detailImage
            ],
            'initialPreviewAsData'=>true,
        ];        
    }
}
$galleryPreview = [];
$galleryPreviewConfig = [];
if (!empty($galleryImageList)) {
    foreach ($galleryImageList as $gallery) {       
        array_push($galleryPreview,$gallery->url);
        array_push($galleryPreviewConfig,[
            'url' =>  Url::toRoute(['/gallery/delete/' . $gallery->id])
        ]);
    }
}

$trailersPreview = [];
$trailersPreviewConfig = [];
if (!empty($trailersVideoList)) {
    foreach ($trailersVideoList as $trailers) {       
        array_push($trailersPreview,$trailers->url);
        array_push($trailersPreviewConfig,[
            'url' =>  Url::toRoute(['/trailers/delete/' . $trailers->id]),
            'filetype'=> "video/mp4",            
        ]);
    }
}
$kinopanoramaPluginOptions = [
            'previewFileType' => 'video',
            'showRemove' => false,
            'initialPreviewFileType'=> 'video',
            'initialPreviewConfig'=> [
                ['filetype'=> "video/mp4"]
            ],
            'validateInitialCount' => true,
            'initialPreviewAsData' => true,
            'allowedFileExtensions' => [ 'mp4','mkv'],
            'showUpload' => true
    ];
if ($model->kinopanorama) {
    $kinopanoramaPluginOptions = array_merge($kinopanoramaPluginOptions, [
        'initialPreview'=>[
             $model->kinopanorama->url
        ],
        'initialPreviewAsData'=>true,
    ]);
}

?>

<div class="film-edit-form">
<?php 
    $form = ActiveForm::begin([
            //'enableClientValidation' => false,
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
        ]);
?>
<ul class="nav nav-tabs">
<li class="active"><a href="#tab1" data-toggle="tab">Основное</a></li>
<li><a href="#tab2" data-toggle="tab">Анонс</a></li>
<li><a href="#tab3" data-toggle="tab">Описание</a></li>
<li><a href="#tab4" data-toggle="tab">Кинопанорама</a></li>
<?php if ($update): ?>
<li><a href="#tab5" data-toggle="tab">Галерея</a></li>
<li><a href="#tab6" data-toggle="tab">Трейлеры</a></li>
<?php endif;?>
</ul>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1">
            <div class="box box-default">
                <div class="box-body">  
                <?php echo $form->field($model, 'name')->textInput()?>
                <?php echo $form->field($model, 'code')->textInput()?>
                <?php echo $form->field($model, 'media')
                        ->dropDownList($model->mediaList())?>
                <?php echo $form->field($model, 'category')
                        ->dropDownList($model->categoriesList())?>
                <?php echo $form->field($model, 'country')
                        ->dropDownList($model->countriesList())?>
                <?php echo $form->field($model, 'year')->textInput()?>
                <?php echo $form->field($model, 'time')->textInput()?>
                <?php echo $form->field($model, 'rating')->textInput()?>
<?php  echo $form->field($model, 'genreList')->widget(MultiSelectListBox::className(),[
    'data' => $model->getGenres(),
    'options' => [
        'multiple'=>"multiple"
    ],
    'clientOptions' => [
    ]
])  ?>                    
<?php  echo $form->field($model, 'editorsList')->widget(MultiSelectListBox::className(),[
    'data' => $personList,
    'options' => [
        'multiple'=>"multiple"
    ],
    'clientOptions' => [
    ]
])  ?>
<?php  echo $form->field($model, 'actorsList')->widget(MultiSelectListBox::className(),[
    'data' => $personList,
    'options' => [
        'multiple'=>"multiple"
    ],
    'clientOptions' => [
        //'selectableHeader' => "<input type='text' class='search-input' autocomplete='off' placeholder='try \"12\"'>",
        // yep, events MUST use JsExpression
        //'afterInit' => new JsExpression('console.log("ok")')
    ]
])  ?>
                </div>            
            </div>
        </div>
        <div class="tab-pane fade" id="tab2">
            <div class="box box-default">
                <div class="box box-default">
                    <div class="box-body">
                    <?= $form->field($model, 'anonsImageFile')->widget(FileInput::class, 
                        [
                            'options' => [
                                'accept' => 'image/*',
                                'multiple' => false
                            ],
                            'pluginOptions' => $pluginAnonsImageOptions
                        ])
                    ?>
                        <?php echo $form->field($model, 'previewText')->widget(CKEditor::class)?>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab3">
            <div class="box box-default">
                <div class="box-body">
                    <?= $form->field($model, 'detailImageFile')->widget(FileInput::class, 
                        [
                            'options' => [
                                'accept' => 'image/*',
                                'multiple' => false
                            ],
                            'pluginOptions' => $pluginDetailImageOptions
                        ])
                    ?>                    
                    <?php echo $form->field($model, 'detailText')->widget(CKEditor::class)?>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab4">
            <div class="box box-default">
                <div class="box-body">
<?php   
    echo $form->field($model, 'kinopanoramaActive')->radioList([
        0 => 'Выключить',
        1 => 'Включить'
    ]);
    echo $form->field($model, 'kinopanoramaFile')->widget(FileInput::classname(), [
        'options' => ['accept' => '/video/*', 'multiple' => false],
        'pluginOptions' =>  $kinopanoramaPluginOptions
    ]); 
?>
                </div>
            </div>
        </div>
<?php if ($update) : ?>
        <div class="tab-pane fade" id="tab5">
            <div class="box box-default">
                <div class="box-body">
<?php
    echo $form->field($model->gallery, 'files[]')->widget(FileInput::classname(), [
    'name' => 'attachment[]',
    'language' => 'ru',
    'pluginOptions' => [
        'initialPreviewConfig' => $galleryPreviewConfig,
        'initialPreview'=> $galleryPreview,
        'initialPreviewAsData'=>true,
        'initialPreviewAsData'=>true,
        'overwriteInitial' => false,
        'showCaption' => false,
        'showRemove' => true,
        'showUpload' => true,
        'browseClass' => 'btn btn-primary btn-block',
        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
        'browseLabel' =>  'Добавить фото...',
        'uploadUrl' => Url::to(['/gallery/upload/'.$filmId])//. $model->id
    ],
    'options' => [
        'accept' => 'image/*', 
        'multiple' => true,
        'maxFileCount' => 10,
        'maxFileSize'=>1000,
    ],

]);
?>
                </div>                    
            </div>                
        </div>
        <div class="tab-pane fade" id="tab6">
            <div class="box box-default">
                <div class="box-body">
<?php
    echo $form->field($model->trailers, 'files[]')->widget(FileInput::classname(), [
    'name' => 'attachment[]',
    'language' => 'ru',
    'pluginOptions' => [
        'initialPreviewConfig' => $trailersPreviewConfig,
        'initialPreview'=> $trailersPreview,
        'initialPreviewAsData'=>true,
        'initialPreviewAsData'=>true,
        'initialPreviewFileType'=> 'video',
        'overwriteInitial' => false,
        'showCaption' => false,
        'showRemove' => true,
        'showUpload' => true,
        'allowedFileExtensions' => [ 'mp4'],
        'browseClass' => 'btn btn-primary btn-block',
        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
        'browseLabel' =>  'Добавить видео...',
        'uploadUrl' => Url::to(['/trailers/upload/'.$filmId])//. $model->id
    ],
    'options' => [
        'accept' => 'video/*', 
        'multiple' => true,
        'maxFileCount' => 10,
        'maxFileSize'=>1000,
    ],

]);
?>
                </div>                    
            </div>                
        </div>
<?php endif; ?>        
    </div>
    
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>

