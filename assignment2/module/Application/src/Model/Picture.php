<?php

namespace Application\Model;

class Picture
{
    private $id;
    private $authorName;
    private $pictureTitle;
    private $fileName;
    private $pictureDescription;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
    * @return mixed
    */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
    * @param mixed $id
    * @return $this
    */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
        return $this;
    }

    /**
    * @return mixed
    */
    public function gePictureTitle()
    {
        return $this->pictureTitle;
    }

    public function setTitle($pictureTitle)
    {
        $this->pictureTitle = $pictureTitle;
        return $this;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getPictureDescription()
    {
        return $this->pictureDescription;
    }

    public function setPictureDescription($pictureDescription)
    {
        $this->pictureDescription = $pictureDescription;
        return $this;
    }

    public function getArray()
    {
        $data = [
            'id' => $this->getId(),
            'authorName' => $this->getAuthorName(),
            'pictureTitle' => $this->gePictureTitle(),
            'pictureDescription' => $this->getPictureDescription(),
            'filename' => $this->getFileName(),
        ];

        return $data;
    }
}