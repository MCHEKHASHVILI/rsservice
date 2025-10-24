<?php

declare(strict_types=1);

namespace RS\Http\Responses\Waybill;

use RS\Http\Responses\Waybill\WaybillServiceResponse;

class GetExciseCodesResponse extends WaybillServiceResponse
{
    public function parsed(): array
    {
        return parent::parsed()[$this->getSoapAction() . "Result"]["AKCIZ_CODES"]["AKCIZ_CODE"];
    }
}
