<?php
Yii::setAlias('@rbac', dirname(__DIR__) . '\data\rbac');
Yii::setAlias('@filmsAnonsImagePath',   dirname(__DIR__)
        . DIRECTORY_SEPARATOR . 'web' 
        . DIRECTORY_SEPARATOR . 'files' 
        . DIRECTORY_SEPARATOR . 'images'
        . DIRECTORY_SEPARATOR . 'films'
        . DIRECTORY_SEPARATOR . 'anons'
        );
Yii::setAlias('@filmsAnonsImageUrl', '/files/images/films/anons');
Yii::setAlias('@filmsKinopanoramaMediaPath',   dirname(__DIR__)
        . DIRECTORY_SEPARATOR . 'web' 
        . DIRECTORY_SEPARATOR . 'files'
        . DIRECTORY_SEPARATOR . 'media'
        . DIRECTORY_SEPARATOR . 'kinopanorama'
        );