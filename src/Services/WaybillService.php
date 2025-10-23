<?php

declare(strict_types=1);

namespace Mchekhashvili\Rsservice\Services;

use Mchekhashvili\Rsservice\Dtos\ServiceUserDto;
use Mchekhashvili\Rsservice\Contracts\ConnectionContract;
use Mchekhashvili\Rsservice\Dtos\MainUserDto;

class WaybillService extends RSService
{
    public function __construct(protected ConnectionContract $connectionContract) {}

    public function checkServiceUser(ServiceUserDto $serviceUserDto): bool
    {
        return $this->connectionContract->checkServiceUser($serviceUserDto);
    }

    public function getErrorCodes(ServiceUserDto $serviceUserDto)
    {
        return $this->connectionContract->getErrorCodes($serviceUserDto);
    }

    public function getServiceUsers(MainUserDto $mainUserDto): array
    {
        return $this->connectionContract->getServiceUsers($mainUserDto);
    }

    public function getMyIp(): string
    {
        return $this->connectionContract->getMyIp();
    }

    public function createWaybill(array $data)
    {
        return $this->connectionContract->createWaybill($data);
    }

    public function getExciseCodes(ServiceUserDto $serviceUserDto): array
    {
        return $this->connectionContract->getExciseCodes($serviceUserDto);
    }

    public function getWaybillTypes(ServiceUserDto $serviceUserDto): array
    {
        return $this->connectionContract->getWaybillTypes($serviceUserDto);
    }

    public function getWaybillUnits(ServiceUserDto $serviceUserDto): array
    {
        return $this->connectionContract->getWaybillUnits($serviceUserDto);
    }
    public function getTransportationTypes(ServiceUserDto $serviceUserDto): array
    {
        return $this->connectionContract->getTransportationTypes($serviceUserDto);
    }
    public function getWaybillById(ServiceUserDto $serviceUserDto, int $id): array
    {
        return $this->connectionContract->getWaybillById($serviceUserDto, $id);
    }
}
