<?php

namespace Nomisoft\Alexa\Response\Card;

/**
 * Class Simple
 * @package Nomisoft\Alexa\Response\Card
 */
class Simple extends Nomisoft\Alexa\Response\Card
{
    /**
     * @var
     */
    private $title;

    /**
     * @var
     */
    private $content;

    /**
     * @return mixed
     */
    public function getType()
    {
        return 'Simple';
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
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'title' => $this->getTitle(),
            'content' => $this->getContent()
        ];
    }
}