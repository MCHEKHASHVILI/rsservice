<?php

declare(strict_types=1);

namespace RS\Responses\Waybill;

use RS\Responses\Waybill\WaybillServiceResponse;

class CheckServiceUserResponse extends WaybillServiceResponse
{
    public function parsed(): bool
    {
        return parent::parsed() === "true";
    }
}
