<?php

namespace app\core\services\operations\Audio;

use app\models\Forms\Manage\Audio\TrackForm;
use app\core\repositories\Audio\TrackRepository;
use app\models\ActiveRecord\Audio\Track;


/**
 * Description of TrackService
 *
 * @author kotov
 */
class TrackService
{
    /**
     *
     * @var TrackRepository
     */
    protected $tracks;

    public function __construct(
        TrackRepository $trackRepository
            )
    {
        $this->tracks = $trackRepository;
    }
    
    public function create(TrackForm $form)
    {
        $track = Track::create(
                $form->name,
                $form->track,
                $form->media,
                $form->album
                );
        $this->tracks->save($track);
        return $track;
    }
    
    public function edit($id, TrackForm $form)
    {
        /* @var $track Track */
        $track = $this->tracks->findById($id);
        $track->edit(
                $form->name, 
                $form->track, 
                $form->media
                );
        $this->tracks->save($track);
    }

    public function remove($id)
    {
        /* @var $track Track */
        $track = $this->tracks->findById($id);
        $this->tracks->remove($track);
    }
    
    
}
