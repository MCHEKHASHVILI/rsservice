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

    /**
     * @todo remove credentials from this file
     */
    function dumperrorIfExistsinResponse($response)
    {

        $serviceUserDto = new ServiceUserDto("rsserviceuser:206322102", "Password123!@#");

        $errors = $this->getErrorCodes($serviceUserDto);

        $error = array_filter($errors, fn($val, $key) => $val['ID'] === $response['STATUS'], ARRAY_FILTER_USE_BOTH);

        if ($error) {
            dd(array_merge(["ERROR_DETAILS" => array_values($error)[0]], ["RESPONSE" => $response]));
        }
    }

    public function createWaybill(array $data)
    {
        $responseXml = $this->client->save_waybill($data);
        $simpleXmlObject = new SimpleXMLElement($responseXml->save_waybillResult->any);
        $convertedToArray = json_decode(json_encode($simpleXmlObject), TRUE);
        $this->dumperrorIfExistsinResponse($convertedToArray);

        $result = $responseXml;

        return $result;
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

    public function getMyIp(): string
    {
        $responseXml = $this->client->what_is_my_ip();
        return $responseXml->what_is_my_ipResult;
    }



    public function getExciseCodes(ServiceUserDto $serviceUserDto): array
    {
        $responseXml = $this->client->get_akciz_codes($serviceUserDto->toArray());
        $simpleXmlObject = new SimpleXMLElement($responseXml->get_akciz_codesResult->any);
        $convertedToArray = json_decode(json_encode($simpleXmlObject), TRUE)["AKCIZ_CODE"];
        return $convertedToArray;
    }

    public function getWaybillTypes(ServiceUserDto $serviceUserDto): array
    {
        $responseXml = $this->client->get_waybill_types($serviceUserDto->toArray());
        $simpleXmlObject = new SimpleXMLElement($responseXml->get_waybill_typesResult->any);
        $convertedToArray = json_decode(json_encode($simpleXmlObject), TRUE)["WAYBILL_TYPE"];
        return $convertedToArray;
    }

    public function getWaybillUnits(ServiceUserDto $serviceUserDto): array
    {
        $responseXml = $this->client->get_waybill_units($serviceUserDto->toArray());
        $simpleXmlObject = new SimpleXMLElement($responseXml->get_waybill_unitsResult->any);
        $convertedToArray = json_decode(json_encode($simpleXmlObject), TRUE)["WAYBILL_UNIT"];
        return $convertedToArray;
    }
    public function getTransportationTypes(ServiceUserDto $serviceUserDto): array
    {
        $responseXml = $this->client->get_trans_types($serviceUserDto->toArray());
        $simpleXmlObject = new SimpleXMLElement($responseXml->get_trans_typesResult->any);
        $convertedToArray = json_decode(json_encode($simpleXmlObject), TRUE)["TRANSPORT_TYPE"];
        return $convertedToArray;
    }

    public function getWaybillById(ServiceUserDto $serviceUserDto, int $id): array
    {
        $responseXml = $this->client->get_waybill(array_merge($serviceUserDto->toArray(), ["waybill_id" => $id]));
        $simpleXmlObject = new SimpleXMLElement($responseXml->get_waybillResult->any);
        $convertedToArray = json_decode(json_encode($simpleXmlObject), TRUE);
        /**@todo remove this dumper*/
        $this->dumperrorIfExistsinResponse($convertedToArray);
        return $convertedToArray;
    }
}
