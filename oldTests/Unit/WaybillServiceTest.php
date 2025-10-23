<?php

use Saloon\Http\Response;
use Saloon\XmlWrangler\XmlReader;
use Saloon\Exceptions\Request\RequestException;

use Mchekhashvili\Rsservice\Requests\CheckServiceUserRequest;
use Mchekhashvili\Rsservice\Connectors\WaybillServiceConnector;

class WaybillServiceTest
{
    public function test_saloon_request()
    {
        $connector = new WaybillServiceConnector();
        $promise = $connector->sendAsync(new CheckServiceUserRequest())
            ->then(function (Response $response) {
                $reader = XmlReader::fromString($response->body());

                $results = $reader->value('soap:Envelope.soap:Body.chek_service_userResponse')->sole();
                // $this->assertArrayHasKey("chek_service_userResult", $results,  "There was some error");
            })
            ->otherwise(function (RequestException $exception) {
                dd("Exception", $exception);
            });

        $promise->wait();
    }
}
