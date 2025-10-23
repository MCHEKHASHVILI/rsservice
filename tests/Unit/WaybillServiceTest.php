<?php

use Saloon\Http\Response;
use Saloon\XmlWrangler\XmlReader;
use Saloon\Exceptions\Request\RequestException;
use Mchekhashvili\Rsservice\Requests\CheckServiceUserRequest;
use Mchekhashvili\Rsservice\Connectors\WaybillServiceConnector;

test('Checks service user', function () {
    $connector = new WaybillServiceConnector();
    $promise = $connector->sendAsync(new CheckServiceUserRequest())
        ->then(function (Response $response) {
            $reader = XmlReader::fromString($response->body());
            $results = $reader->value('soap:Envelope.soap:Body.chek_service_userResponse')->sole();
            expect($results["chek_service_userResult"])->toBe("true");
        })
        ->otherwise(function (RequestException $exception) {
            throw $exception;
        });
    $promise->wait();
});
