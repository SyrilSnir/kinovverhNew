<?php
Yii::setAlias('@views', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views');
Yii::setAlias('@widgets', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'widgets');
Yii::setAlias('@kinozalViews', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' 
        . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'kinozal' . DIRECTORY_SEPARATOR. 'views');
Yii::setAlias('@layouts', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app'. DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts');
Yii::setAlias('@modules', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app'. DIRECTORY_SEPARATOR . 'modules');
Yii::setAlias('@filmsAnonsImagePath',   dirname(__DIR__)
        . DIRECTORY_SEPARATOR . 'web' 
        . DIRECTORY_SEPARATOR . 'files' 
        . DIRECTORY_SEPARATOR . 'images'
        . DIRECTORY_SEPARATOR . 'films'
        . DIRECTORY_SEPARATOR . 'anons'
        );
Yii::setAlias('@filmsDetailImagePath',   dirname(__DIR__)
        . DIRECTORY_SEPARATOR . 'web' 
        . DIRECTORY_SEPARATOR . 'files' 
        . DIRECTORY_SEPARATOR . 'images'
        . DIRECTORY_SEPARATOR . 'films'
        . DIRECTORY_SEPARATOR . 'detail'
        );
Yii::setAlias('@filmsKinopanoramaMediaPath',   dirname(__DIR__)
        . DIRECTORY_SEPARATOR . 'web' 
        . DIRECTORY_SEPARATOR . 'files'
        . DIRECTORY_SEPARATOR . 'media'
        . DIRECTORY_SEPARATOR . 'kinopanorama'
        );
Yii::setAlias('@galleryPath',   dirname(__DIR__)
        . DIRECTORY_SEPARATOR . 'web'
        . DIRECTORY_SEPARATOR . 'files'
        . DIRECTORY_SEPARATOR . 'images'
        . DIRECTORY_SEPARATOR . 'gallery'
        );
Yii::setAlias('@trailersPath',   dirname(__DIR__)
        . DIRECTORY_SEPARATOR . 'web'
        . DIRECTORY_SEPARATOR . 'files'
        . DIRECTORY_SEPARATOR . 'media'
        . DIRECTORY_SEPARATOR . 'trailers'
        );
Yii::setAlias('@kinofilmPath',   dirname(__DIR__)
        . DIRECTORY_SEPARATOR . 'web'
        . DIRECTORY_SEPARATOR . 'files'
        . DIRECTORY_SEPARATOR . 'media'
        . DIRECTORY_SEPARATOR . 'films'
        );
Yii::setAlias('@audioPath',   dirname(__DIR__)
        . DIRECTORY_SEPARATOR . 'web'
        . DIRECTORY_SEPARATOR . 'files'
        . DIRECTORY_SEPARATOR . 'media'
        . DIRECTORY_SEPARATOR . 'tracks'
        );
Yii::setAlias('@albumPath',   dirname(__DIR__)
        . DIRECTORY_SEPARATOR . 'web'
        . DIRECTORY_SEPARATOR . 'files'
        . DIRECTORY_SEPARATOR . 'images'
        . DIRECTORY_SEPARATOR . 'albums'
        );
Yii::setAlias('@mainPageCarouselPath',   dirname(__DIR__)
        . DIRECTORY_SEPARATOR . 'web'
        . DIRECTORY_SEPARATOR . 'files'
        . DIRECTORY_SEPARATOR . 'widgets'
        . DIRECTORY_SEPARATOR . 'main-page-carousel'
        . DIRECTORY_SEPARATOR . 'gallery'
        );

Yii::setAlias('@filmsImageUrl', '/files/images/films');
Yii::setAlias('@filmsAnonsImageUrl', '/files/images/films/anons');
Yii::setAlias('@filmsDetailImageUrl', '/files/images/films/detail');
Yii::setAlias('@filmsKinopanoramaUrl', '/files/media/kinopanorama');
Yii::setAlias('@galleryUrl', '/files/images/gallery');
Yii::setAlias('@mainPageCarouselUri', '/files/widgets/main-page-carousel/gallery');
Yii::setAlias('@trailersUrl', '/files/media/trailers');
Yii::setAlias('@kinofilmUrl', '/files/media/films');
Yii::setAlias('@audioUrl', '/files/media/tracks');
Yii::setAlias('@albumUrl', '/files/images/albums');
