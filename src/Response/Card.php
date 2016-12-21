<?php

namespace Nomisoft\Alexa\Response;

/**
 * Class Card
 * @package Nomisoft\Alexa\Response
 */
class Card implements \JsonSerializable
{

    /**
     * @var
     */
    private $type = 'Simple';

    /**
     * @var
     */
    private $title;

    /**
     * @var
     */
    private $content;

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
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        //todo: must be Simple, Standard, LinkAccount
        $this->type = $type;
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
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
        //todo: only output set variables
        return [
            'type' => $this->type,
            'title' => $this->title,
            'content' => $this->content,
            'text' => $this->text,
            'image' => [
                'smallImageUrl' => $this->smallImage,
                'largeImageUrl' => $this->largeImage
            ]
        ];
    }
}