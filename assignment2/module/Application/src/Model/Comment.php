<?php

namespace Application\Model;

class Comment
{
    private $comment;

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    public function getArray()
    {
        $data = [
            'comment' => $this->getComment(),
        ];

        return $data;
    }
}