<?php

declare(strict_types=1);

namespace RS\Enums\Endpoints;

enum SoapApiEndpoint: string
{
    case WAYBILL = "https://services.rs.ge/WayBillService/WayBillService.asmx?WSDL";
}
