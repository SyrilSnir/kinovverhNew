<?php

namespace app\widgets\Comments;

use app\models\Forms\Comments\CommentForm;
use app\models\ActiveRecord\Film\Film;
use yii\base\Widget;

/**
 * Description of CommentsWidget
 *
 * @author kotov
 */
class CommentsWidget extends Widget
{
    /**
     *
     * @var Film
     */
    public $film;
    
    /**
     *
     * @var CommentForm
     */
    public $commentForm;
   
    public function __construct(
            CommentForm $form,
            $config = array()
            )
    {
        parent::__construct($config);
        $this->commentForm = $form;
        $this->commentForm->filmId = $this->film->id;
        $this->commentForm->filmSlug = $this->film->code;
    }

    public function run(): string
    {
        return $this->render('index',[
            'film' => $this->film,
            'commentForm' => $this->commentForm
        ]);
    }
}
