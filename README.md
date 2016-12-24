# PHP Alexa Helpers

A library to ease development when working with the Amazon Alexa API

## Installation

```
composer require nomisoft/php-alexa-helper
```

## Usage

### Requests

This will capture the JSON from the POST request

```php
use \Alexa\Request\AlexaRequest;
$alexaRequest = AlexaRequest::fromRequest();
```

If you've already captured the posted JSON and have it in a variable you can pass it in to the constructor of the AlexaRequest class

```php
$alexaRequest = new AlexaRequest($json);
```

The $alexaRequest object now behaves like an object representing the JSON posted by the Alexa API. You can directly access the properties as they match the JSON for example:
```php
$alexaRequest->version;
$alexaRequest->session->application->applicationId;
$alexaRequest->request->intent->slots->ZodiacSign->value;
```

There are a few shortcut functions available

**$alexaRequest->getType()** is a shortcut returning the value of request->type from the JSON

**$alexaRequest->getIntent()** is a shortcut returning the value of request->intent->name from the JSON

**$alexaRequest->getSlots()** returns a key/value array of the intent slots. For example `"slots": { "ZodiacSign": { "name": "ZodiacSign", "value": "virgo" } }` would return `array('ZodiacSign'=>'virgo')`

### Validating requests

Skills being submitted for Alexa approval also need an extra step in verifying the requests come from Amazon. The RequestValidator class will do all necessary timestamp and certificate checks.

```php
use \Alexa\Request\AlexaRequest;
use \Alexa\Request\RequestValidator;
$alexaRequest = AlexaRequest::fromRequest();
$validator = new RequestValidator($request);
if (!$validator->validate('YOUR_APP_ID')) {
    print_r($validator->getErrors());
}
```
### Responses

To respond to the Alexa request you can construct an OutputSpeech object

```php
use \Alexa\Request\AlexaRequest;
use \Alexa\Request\OutputSpeech;
$response = new AlexaResponse();
$speech = new OutputSpeech();
$speech->setText('Hello World');
$response->setOutputSpeech($speech);
```
When you invoke your Alexa skill your Amazon Echo (or other Alexa enabled device) will respond by saying 'Hello World'

By default a 'PlainText' type of speech response will be used. You can also respond using SSML

```php
$speech = new OutputSpeech();
$speech->setType('SSML');
$speech->setText('<speak>Hello <say-as interpret-as="spell-out">world</say-as>.</speak>');
```

If you wish to also send a 'card' response which is shown on screen in the Alexa app you can create a Card object. The below example is for a 'Simple' card with just some text

```php
use \Alexa\Request\Card;
$card = new Card();
$card->setContent('Hello World');
$response->setCard($card);
$response->render();
```

As well as setting the cards text content you can also set a title and return images to be displayed

```php
$card = new Card();
$card->setType('Standard');
$card->setTitle('Hello World Title');
$card->setText('Hello World Content');
$card->setSmallImage('http://example.com/small.jpg');
$card->setLargeImage('http://example.com/large.jpg');
$response->setCard($card);
```

The AlexaResponse class is JSON serializable so to return your response to Amazon just `echo json_encode($response);` or call `$response->render()`. If you're using Symfony you might return the json with JsonResponse from your controller like:
```php
$jsonResponse = new \Symfony\Component\HttpFoundation\JsonResponse($response);
return $jsonResponse;
```