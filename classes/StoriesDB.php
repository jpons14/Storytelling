<?php

class StoriesDB extends DB
{
    public function __construct(  )
    {
        parent::__construct();
        $this->setTable('stories');
        $this->setFields(['id', 'name', 'subject', 'likes']);
    }

    public function all(  )
    {
        $this->setTable('stories');
        return $this->select();
    }

    public function getStoresByName( $name )
    {
        $return = '';
        try {
            $return = $this->where('name', $name);
        } catch (DBException $exception){
            $exception->showException();
        }
        return $return;
    }

    public function likeIt( $storyId )
    {
        $story = $this->find($storyId);
    }
}