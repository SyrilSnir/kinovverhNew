<?php

use app\models\Forms\Media\Files\VideoFileForm;
use dosamigos\fileupload\FileUploadUI;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\StringHelper;

$fileUploadWidgetConfig = [
            'model' => $model,
            'attribute' => 'file',
            'gallery' => false,
            'clientOptions' => [
                'maxFileSize' => 2000000000
            ],
            // ...
            'clientEvents' => [
                'fileuploaddone' => 'function(e, data) {
                                        console.log(e);
                                        console.log(data);
                                    }',
                'fileuploadfail' => 'function(e, data) {
                                        console.log(e);
                                        console.log(data);
                                    }',
            ],
        ];

if ($model->className() == VideoFileForm::class) {
    $fileUploadWidgetConfig['fieldOptions'] = [        
        'accept' => 'video/mp4'            
    ];
    $fileUploadWidgetConfig['url'] = '/media/upload-video';
    $deleteFileLink = 'delete-video';
}
else {
    $fileUploadWidgetConfig['fieldOptions'] = [        
        'accept' => 'audio/mp3'            
    ]; 
    $fileUploadWidgetConfig['url'] = '/media/upload-audio';    
    $deleteFileLink = 'delete-audio';    
}
echo FileUploadUI::widget($fileUploadWidgetConfig);
?>

    <div class="box">
        <div class="box-head">
            <h3>Загруженные файлы</h3>
        </div>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
             //  'filterModel' => $searchModel,
                'columns' => [
                    '№:text',
                    'name:text:Имя файла',
                    'mime:text:MIME тип',
                    'size:text:Размер',                
                    [
                        'class' => ActionColumn::class,
                        'template' => '{delete}',
                        'header' => 'Действия',
                        'buttons' => [
                           'delete' => function ($url, $model, $key) use ($deleteFileLink) {
                              return Html::a(
                                            '', 
                                            [   
                                                $deleteFileLink, 
                                                'file' => StringHelper::base64UrlEncode($model['name'])
                                            ],
                                            [
                                                'class' => 'glyphicon glyphicon-trash',
                                                'title' => Yii::t('yii', 'Delete'),
                                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                                'data-method' => 'post',                                                
                                            ]);
                           },
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>