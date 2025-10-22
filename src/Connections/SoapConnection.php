<?php

declare(strict_types=1);

namespace Mchekhashvili\Rsservice\Connections;

use SimpleXMLElement;
use Mchekhashvili\Rsservice\Dtos\MainUserDto;
use Mchekhashvili\Rsservice\Dtos\ServiceUserDto;
use Mchekhashvili\Rsservice\Contracts\ConnectionContract;

class SoapConnection implements ConnectionContract
{
    public \SoapClient $client;
    public function __construct(protected readonly string $uri, protected readonly array $options = [])
    {
        $this->client = new \SoapClient($uri, $options);
    }

    public function getServiceUsers(MainUserDto $mainUserDto): array
    {
        $responseXml = $this->client->get_service_users($mainUserDto->toArray());
        $simpleXmlObject = new SimpleXMLElement($responseXml->get_service_usersResult->any);
        $convertedToArray = json_decode(json_encode($simpleXmlObject), TRUE)["ServiceUser"];
        return $convertedToArray;
    }

    public function checkServiceUser(ServiceUserDto $serviceUserDto): bool
    {
        $responseXml = $this->client->chek_service_user($serviceUserDto->toArray());
        return $responseXml->chek_service_userResult;
    }

    public function getErrorCodes(ServiceUserDto $serviceUserDto): array
    {
        $responseXml = $this->client->get_error_codes($serviceUserDto->toArray());
        $simpleXmlObject = new SimpleXMLElement($responseXml->get_error_codesResult->any);
        $convertedToArray = json_decode(json_encode($simpleXmlObject), TRUE)["ERROR_CODE"];
        return $convertedToArray;
    }
}
