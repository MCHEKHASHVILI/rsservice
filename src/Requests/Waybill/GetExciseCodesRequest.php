<?php

namespace RS\Requests\Waybill;

use RS\Requests\Waybill\WaybillServiceRequest;
use RS\Responses\Waybill\GetExciseCodesResponse;

class GetExciseCodesRequest extends WaybillServiceRequest
{
    protected ?string $response = GetExciseCodesResponse::class;
    /**
     * RS Service Operation name
     * as declared in their documentation
     * @var string $SOAPAction
     */
    protected string $SOAPAction = "get_akciz_codes";
}
