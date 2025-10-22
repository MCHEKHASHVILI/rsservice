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
    public function getServiceUsers(MainUserDto $mainUserDto): array;
    public function checkServiceUser(ServiceUserDto $serviceUser): bool;
    public function getErrorCodes(ServiceUserDto $serviceUser): array;
}
