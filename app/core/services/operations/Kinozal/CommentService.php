<?php

namespace app\core\services\operations\Kinozal;

use app\models\ActiveRecord\Film\FilmComment;
use app\core\repositories\Films\CommentsRepository;
use app\models\Forms\Manage\Films\CommentForm;

/**
 * Description of CommentService
 *
 * @author kotov
 */
class CommentService
{
    /**    
     * @param CommentsRepository $comments
     */
    protected $comments;
    
    public function __construct(CommentsRepository $comments)
    {
        $this->comments = $comments; 
    }

    public function create(CommentForm $form) {
        $comment = FilmComment::create(
                $form->filmId, 
                $form->userName, 
                $form->message);
        $this->comments->save($comment);
        return $comment;
    }

    public function edit($id, CommentForm $form)
    {
        /* @var $comment FilmComment */
        $comment = $this->comments->findById($id);
        $comment->edit(
                $form->filmId, 
                $form->userName, 
                $form->message
                );
        $this->comments->save($comment);
    }
    
    public function remove ($id) 
    {        
        /* @var $comment FilmComment */
         $comment = $this->comments->findById($id);
         $this->comments->remove($comment);
    }

    public function publish($id) 
    {         
        $comment = $this->comments->findById($id);
        /* @var $comment FilmComment */
        $comment->publish();
        $this->comments->save($comment);
    }
    
    public function unpublish($id) 
    {         
        $comment = $this->comments->findById($id);
        /* @var $comment FilmComment */
        $comment->unpublish();
        $this->comments->save($comment);
    }
}
