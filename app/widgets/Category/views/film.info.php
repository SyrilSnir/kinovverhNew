<div class="pop-film">
    <div class="pop-film__wrapp">
        <a class="pop-film__play" href="/kinozal/<?php echo $film->code. '/view/'?>"></a>
        <span class="pop-film__vozr"><?php echo $film->category->name ?></span>
        <div class="pop-film__data hidden-mobile">
            <div class="pop-film__arrow"></div>
            <div class="pop-film__data-wrap">
                <p>
                    <a href="/kinozal/<?php echo $film->code ?>" class="btn btn-xs">Смотреть</a>
                    <a href="#pop-enter" class="btn btn-xs" data-toggle="modal" data-id="<?php echo $film->id ?>">Смотреть позже</a>
                </p>
                <p><span>Год выпуска:</span> <?php echo $film->year ?></p>
            <?php if (count($film->editors) > 0): ?>
                <?php if (count($film->editors) === 1): ?>                    
                    <p><span>Режиссер:</span> <?php echo $film->editors[0]->name?></p>
                <?php else: ?>
                <?php
                    $editors = '';
                    foreach ($film->editors as $editor) {
                        $editors.= ' '.$editor->name . ',';
                    }
                    $editors = trim($editors,',');
                ?>
                    <p><span>Режиссеры:</span><?php echo $editors ?></p>
                <?php endif;?>
            <?php endif;?>
            <?php if (count($film->actors) > 0): ?>
                <?php
                    $actors = '';
                    foreach ($film->actors as $actor) {
                        $actors.= ' '.$actor->name . ',';
                    }
                    $actors = trim($actors,',');
                ?>
                     <p><span>В ролях:</span> <?php echo $actors ?></p>
            <?php endif;?>                   
            </div>
        </div>
        <a class="pop-film__image" href="/kinozal/<?php echo $film->code. '/view/'?>">
        <img src="<?php echo $film->anonsImage ?>" class="img-rounded img-responsive"/>
        </a>
        <div class="pop_film__caption">
            <h3><?php echo $film->name; ?></h3>
            <p>(<?php echo $film->year; ?>)</p>
        </div>
    </div>

</div>