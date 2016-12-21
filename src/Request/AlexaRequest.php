<?php

namespace Nomisoft\Alexa\Request;

/**
 * Class AlexaRequest
 * @package Nomisoft\Alexa\Request
 */
class AlexaRequest
{

    /**
     * @param $json
     *
     * @throws \Exception
     */
    public function __construct($json)
    {
        $data = json_decode($json);
        if (is_null($data)) {
            throw new \Exception('Invalid JSON request');
        }
        foreach($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return AlexaRequest
     */
    public static function fromRequest()
    {
        $json = file_get_contents('php://input');
        return new AlexaRequest($json);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->request->type;
    }

    /**
     * @return mixed
     */
    public function getIntent()
    {
        return $this->request->intent;
    }

    /**
     * @return array
     */
    public function getSlots()
    {
        return array_map(function($obj) { return $obj->value; }, get_object_vars($this->getIntent()->slots));
    }


}