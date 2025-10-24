<?php

declare(strict_types=1);

namespace RS\Requests\Waybill;

use RS\Requests\Waybill\WaybillServiceRequest;
use RS\Responses\Waybill\CheckServiceUserResponse;

class CheckServiceUserRequest extends WaybillServiceRequest
{
    protected ?string $response = CheckServiceUserResponse::class;
    /**
     * RS Service Operation name
     * as declared in their documentation
     * @var string $SOAPAction
     */
    protected string $SOAPAction = "chek_service_user";
}
