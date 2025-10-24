<?php

declare(strict_types=1);

namespace RS\Http\Connectors;

use Saloon\Http\Connector;
use RS\Enums\SoapApiEndpoint;
use RS\Enums\SoapApiRequestHeader;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class WaybillServiceConnector extends Connector
{
    use AlwaysThrowOnErrors;
    public function resolveBaseUrl(): string
    {
        return SoapApiEndpoint::WAYBILL->value;
    }

    protected function defaultHeaders(): array
    {
        return [
            "Content-Type" => SoapApiRequestHeader::CONTENT_TYPE->value,
        ];
    }
}
