<?php

namespace Nomisoft\Alexa\Response\Card;

/**
 * Class Standard
 * @package Nomisoft\Alexa\Response\Card
 */
class Standard extends Nomisoft\Alexa\Response\Card
{
    /**
     * @var
     */
    private $title;

    /**
     * @var
     */
    private $text;

    /**
     * @var
     */
    private $smallImage;

    /**
     * @var
     */
    private $largeImage;

    /**
     * @return mixed
     */
    public function getType()
    {
        return 'Standard';
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getSmallImage()
    {
        return $this->smallImage;
    }

    /**
     * @param mixed $smallImage
     */
    public function setSmallImage($smallImage)
    {
        $this->smallImage = $smallImage;
    }

    /**
     * @return mixed
     */
    public function getLargeImage()
    {
        return $this->largeImage;
    }

    /**
     * @param mixed $largeImage
     */
    public function setLargeImage($largeImage)
    {
        $this->largeImage = $largeImage;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'title' => $this->getTitle(),
            'text' => $this->getText(),
            'image' => [
                'smallImageUrl' => $this->getSmallImage(),
                'largeImageUrl' => $this->getLargeImage()
            ]
        ];
    }
}