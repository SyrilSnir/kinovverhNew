<?php

use app\widgets\Category\ShowCategoryWidget;

$this->title = 'Фильмы';
?>
<div class="container">
<?php
echo ShowCategoryWidget::widget([
    'category' => $category
]);
?>
</div>
