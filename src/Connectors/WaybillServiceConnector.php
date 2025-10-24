<?php

declare(strict_types=1);

namespace RS\Connectors;

use Saloon\Http\Connector;

class WaybillServiceConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https://services.rs.ge/WayBillService/WayBillService.asmx?WSDL';
    }

    protected function defaultHeaders(): array
    {
        return [
            "Content-Type" => "text/xml; charset=utf-8",
        ];
    }
}
