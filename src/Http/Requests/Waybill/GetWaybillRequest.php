<?php

namespace RS\Http\Requests\Waybill;

use Throwable;
use Saloon\Http\Response;
use RS\Http\Responses\Waybill\GetWaybillResponse;
use Saloon\Exceptions\Request\Statuses\NotFoundException;

class GetWaybillRequest extends WaybillServiceRequest
{
    protected ?string $response = GetWaybillResponse::class;
    public function __construct(
        /**
         * RS Service Operation name
         * as declared in their documentation
         * @var string $action
         */
        public readonly string $action = "get_waybill"
    ) {}

    public function hasRequestFailed(Response $response): ?bool
    {
        return ! $response->resourceRetrieved();
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        return new NotFoundException($response, 'Waybill not found', 404, $senderException);
    }
}
