<?php

declare(strict_types=1);

namespace RS\Http\Responses\Waybill;

use RS\Http\Responses\Waybill\WaybillServiceResponse;

class GetErrorCodesResponse extends WaybillServiceResponse
{
    public function parsed(): array
    {
        return parent::parsed()[$this->getSoapAction() . "Result"]["ERROR_CODES"]["ERROR_CODE"];
    }
}
