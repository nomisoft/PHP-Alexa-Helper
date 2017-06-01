<?php

namespace Nomisoft\Alexa\Response;

/**
 * Class Card
 * @package Nomisoft\Alexa\Response
 */
abstract class Card implements \JsonSerializable
{
    /**
     * @return mixed
     */
    abstract public function getType() {}

    /**
     * @return array
     */
    abstract public function jsonSerialize() {}
}