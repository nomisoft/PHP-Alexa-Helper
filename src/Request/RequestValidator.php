<?php

namespace Nomisoft\Alexa\Request;

/**
 * Class RequestValidator
 * @package Nomisoft\Alexa\Request
 */
class RequestValidator
{

    /**
     * @var
     */
    private $request;

    /**
     * @var
     */
    private $errors;

    /**
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @param $applicationId
     *
     * @return bool
     */
    public function validate($applicationId)
    {
        if( !$this->validateTimestamp() ) {
            return false;
        }
        if( !$this->validateSignatureUrl() ) {
            return false;
        }
        if( !$this->validateApplicationId($applicationId) ) {
            return false;
        }
        if( !$this->validateCertificate() ) {
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    private function validateTimestamp()
    {
        $now = new \DateTime();
        $requestTime = new \DateTime($this->request->request->timestamp);
        if ($now->getTimestamp() - $requestTime->getTimestamp() > 60) {
            $this->errors[] = 'Invalid timestamp';
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    private function validateSignatureUrl()
    {
        if (!array_key_exists('HTTP_SIGNATURECERTCHAINURL',$_SERVER)) {
            $this->errors[] = 'Signature certificate chain url header not found';
            return false;
        }
        $url = parse_url($_SERVER['HTTP_SIGNATURECERTCHAINURL']);
        if (strcasecmp($url['host'], 's3.amazonaws.com') != 0) {
            $this->errors[] = 'The URL host in the signature header is invalid';
            return false;
        }
        if (strpos($url['path'], '/echo.api/') !== 0) {
            $this->errors[] = 'The URL path in the signature header is invalid';
            return false;
        }
        if (strcasecmp($url['scheme'], 'https') != 0) {
            $this->errors[] = 'The URL in the signature header is not using HTTPS';
            return false;
        }
        if (array_key_exists('port', $url) && $url['port'] != '443') {
            $this->errors[] = 'The URL in the signature header is not using the correct port';
            return false;
        }
        return true;
    }

    /**
     * @param $applicationId
     *
     * @return bool
     */
    private function validateApplicationId($applicationId)
    {
        if( $this->request->context->application->applicationId != $applicationId) {
            $this->errors[] = 'Invalid application id';
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    private function validateCertificate()
    {
        if (!array_key_exists('HTTP_SIGNATURE',$_SERVER)) {
            $this->errors[] = 'Signature header not found';
            return false;
        }

        $pem = file_get_contents($_SERVER['HTTP_SIGNATURECERTCHAINURL']);

        if ( !openssl_verify( $this->request->getJson(), base64_decode($_SERVER['HTTP_SIGNATURE']), $pem, 'sha1' )) {
            $this->errors[] = 'Certificate verification failed';
            return false;
        }

        $cert = openssl_x509_parse($pem);
        if (!$cert) {
            $this->errors[] = 'x509 parsing failed';
            return false;
        }

        if( strpos($cert['extensions']['subjectAltName'], 'echo-api.amazon.com') === false) {
            $this->errors[] = 'subjectAltName is invalid';
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

}