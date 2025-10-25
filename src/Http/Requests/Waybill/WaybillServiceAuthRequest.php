<?php

namespace RS\Http\Requests\Waybill;

use Throwable;
use Saloon\Http\Response;
use Saloon\Exceptions\Request\Statuses\UnauthorizedException;

class WaybillServiceAuthRequest extends WaybillServiceRequest
{
    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        return new UnauthorizedException($response, 'unauthorized', 401, $senderException);
    }
}
