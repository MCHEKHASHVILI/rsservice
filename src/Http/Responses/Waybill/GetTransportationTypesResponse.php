<?php

declare(strict_types=1);

namespace RS\Http\Responses\Waybill;

use RS\Http\Responses\Waybill\WaybillServiceResponse;

class GetTransportationTypesResponse extends WaybillServiceResponse
{
    public function parsed(): array
    {
        return parent::parsed()[$this->getSoapAction() . "Result"]["TRANSPORT_TYPES"]["TRANSPORT_TYPE"];
    }
}
