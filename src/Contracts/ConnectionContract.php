<?php

declare(strict_types=1);

namespace Mchekhashvili\Rsservice\Contracts;

use Mchekhashvili\Rsservice\Dtos\MainUserDto;
use Mchekhashvili\Rsservice\Dtos\ServiceUserDto;

/**
 * There might be several connections in future
 * There is only SOAP connection for now
 */
interface ConnectionContract
{
    public function createWaybill(array $data);
    public function getServiceUsers(MainUserDto $mainUserDto): array;
    public function checkServiceUser(ServiceUserDto $serviceUser): bool;
    public function getErrorCodes(ServiceUserDto $serviceUser): array;
    public function getMyIp(): string;
    public function getExciseCodes(ServiceUserDto $serviceUser): array;
    public function getWaybillTypes(ServiceUserDto $serviceUser): array;
    public function getWaybillUnits(ServiceUserDto $serviceUser): array;
    public function getTransportationTypes(ServiceUserDto $serviceUser): array;
    public function getWaybillById(ServiceUserDto $serviceUser, int $id): array;
}
