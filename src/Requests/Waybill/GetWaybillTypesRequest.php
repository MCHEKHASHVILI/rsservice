<?php

namespace RS\Requests\Waybill;

use RS\Requests\Waybill\WaybillServiceRequest;
use RS\Responses\Waybill\GetWaybillTypesResponse;

class GetWaybillTypesRequest extends WaybillServiceRequest
{
    protected ?string $response = GetWaybillTypesResponse::class;
    /**
     * RS Service Operation name
     * as declared in their documentation
     * @var string $SOAPAction
     */
    protected string $SOAPAction = "get_waybill_types";
}
