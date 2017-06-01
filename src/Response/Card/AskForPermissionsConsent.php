<?php

namespace Nomisoft\Alexa\Response\Card;

/**
 * Class AskForPermissionsConsent
 * @package Nomisoft\Alexa\Response\Card
 */
class AskForPermissionsConsent extends Nomisoft\Alexa\Response\Card
{
    /**
     * @var
     */
    private $permissions;

    /**
     * @return mixed
     */
    public function getType()
    {
        return 'AskForPermissionsConsent';
    }

    /**
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param mixed $permissions
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'permissions' => $this->getPermissions()
        ];
    }
}