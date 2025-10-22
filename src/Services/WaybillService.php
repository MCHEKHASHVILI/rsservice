<?php

declare(strict_types=1);

namespace Mchekhashvili\Rsservice\Services;

use Mchekhashvili\Rsservice\Dtos\ServiceUserDto;
use Mchekhashvili\Rsservice\Contracts\ConnectionContract;
use Mchekhashvili\Rsservice\Dtos\MainUserDto;

class WaybillService extends RSService
{
    public function __construct(protected ConnectionContract $connectionContract) {}

    public function checkServiceUser(ServiceUserDto $serviceUserDto)
    {
        return $this->connectionContract->checkServiceUser($serviceUserDto);
    }

    public function getErrorCodes(ServiceUserDto $serviceUserDto)
    {
        return $this->connectionContract->getErrorCodes($serviceUserDto);
    }

    public function getServiceUsers(MainUserDto $mainUserDto)
    {
        return $this->connectionContract->getServiceUsers($mainUserDto);
    }
}
