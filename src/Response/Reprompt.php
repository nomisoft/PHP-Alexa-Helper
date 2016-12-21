<?php

namespace Nomisoft\Alexa\Response;

/**
 * Class Reprompt
 * @package Nomisoft\Alexa\Response
 */
class Reprompt implements \JsonSerializable
{

    /**
     * @var
     */
    private $outputSpeech;

    /**
     * @return mixed
     */
    public function getOutputSpeech()
    {
        return $this->outputSpeech;
    }

    /**
     * @param mixed $outputSpeech
     */
    public function setOutputSpeech($outputSpeech)
    {
        $this->outputSpeech = $outputSpeech;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'outputSpeech' => $this->outputSpeech
        ];
    }
}