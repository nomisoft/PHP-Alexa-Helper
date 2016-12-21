<?php

namespace Nomisoft\Alexa\Response;

/**
 * Class AlexaResponse
 * @package Nomisoft\Alexa\Response
 */
class AlexaResponse implements \JsonSerializable
{

    /**
     * @var
     */
    private $outputSpeech;

    /**
     * @var
     */
    private $card;

    /**
     * @var
     */
    private $reprompt;

    /**
     * @var
     */
    private $directives;

    /**
     * @var bool
     */
    private $shouldEndSession = true;

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
     * @return mixed
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param mixed $card
     */
    public function setCard($card)
    {
        $this->card = $card;
    }

    /**
     * @return mixed
     */
    public function getReprompt()
    {
        return $this->reprompt;
    }

    /**
     * @param mixed $reprompt
     */
    public function setReprompt($reprompt)
    {
        $this->reprompt = $reprompt;
    }

    /**
     * @return mixed
     */
    public function getDirectives()
    {
        return $this->directives;
    }

    /**
     * @param mixed $directives
     */
    public function setDirectives($directives)
    {
        $this->directives = $directives;
    }

    /**
     * @return mixed
     */
    public function getShouldEndSession()
    {
        return $this->shouldEndSession;
    }

    /**
     * @param mixed $shouldEndSession
     */
    public function setShouldEndSession($shouldEndSession)
    {
        $this->shouldEndSession = $shouldEndSession;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $data = [
            "version" => "1.0",
            'response' => [
                'directives' => $this->directives,
                'shouldEndSession' => $this->shouldEndSession
            ]
        ];

        if (!is_null($this->card)) {
            $data['response']['card'] = $this->card;
        }

        if (!is_null($this->outputSpeech)) {
            $data['response']['outputSpeech'] =  $this->outputSpeech;
        }

        if (!is_null($this->reprompt)) {
            $data['response']['reprompt'] = $this->reprompt;
        }

        return $data;
    }

}