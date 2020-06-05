<?php

use app\widgets\Category\ShowCategoryWidget;

$this->title = 'Фильмы';

echo ShowCategoryWidget::widget([
    'category' => $category
]);

