<?php

declare(strict_types=1);

namespace RS\Http\Responses\Waybill;

use RS\Http\Responses\Waybill\WaybillServiceResponse;

class GetWoodTypesResponse extends WaybillServiceResponse
{
    public function parsed(): array
    {
        return parent::parsed()[$this->getSoapAction() . "Result"]["WOOD_TYPES"]["WOOD_TYPE"];
    }
}
