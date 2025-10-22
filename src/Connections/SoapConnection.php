<?php

declare(strict_types=1);

namespace Mchekhashvili\Rsservice\Connections;

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

    public function getServiceUsers(MainUserDto $mainUserDto)
    {
        return $this->client->__soapCall("get_service_users", $mainUserDto->toArray());
    }

    public function checkServiceUser(ServiceUserDto $serviceUserDto)
    {
        return $this->client->__soapCall("chek_service_user", $serviceUserDto->toArray());
    }

    public function getErrorCodes(ServiceUserDto $serviceUserDto)
    {
        return $this->client->__soapCall("get_error_codes", $serviceUserDto->toArray());
    }
}
