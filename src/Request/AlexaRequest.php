<?php

namespace Nomisoft\Alexa\Request;

/**
 * Class AlexaRequest
 * @package Nomisoft\Alexa\Request
 */
class AlexaRequest
{

    /**
     * @var
     */
    private $json;

    /**
     * @param $json
     *
     * @throws \Exception
     */
    public function __construct($json)
    {
        $this->json = $json;
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
    public function getJson()
    {
        return $this->json;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getType()
    {
        if (!property_exists($this, 'request')) {
            throw new \Exception('Invalid JSON request');
        }
        return $this->request->type;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getIntent()
    {
        if (!property_exists($this, 'request')) {
            throw new \Exception('Invalid JSON request');
        }
        return $this->request->intent;
    }

    /**
     * @return array
     */
    public function getSlots()
    {
        return array_map(function($obj) { return $obj->value; }, get_object_vars($this->getIntent()->slots));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getApplicationId()
    {
    	// Testing from AWS console does not give the 'context', but if you use the website http://echosim.io/(or a real devices) then it does.
        if (property_exists($this, 'context') && property_exists($this, 'system')) {
         	return $this->context->system->application->applicationId;
        }
        if (property_exists($this, 'session')) {
            return $this->session->application->applicationId;
        }
        throw new \Exception('Application ID not found');
    }


}