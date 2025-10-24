<?php

declare(strict_types=1);

namespace RS\Http\Responses\Waybill;

use RS\Http\Responses\Waybill\WaybillServiceResponse;

class GetWaybillResponse extends WaybillServiceResponse
{
    public function parsed(): mixed
    {
        return $this->xmlReader()
            ->value("soap:Envelope.soap:Body.{$this->getSOAPAction()}Response")
            ->sole();
    }

    protected function getSOAPAction(): string
    {
        return trim(parse_url($this->pendingRequest->headers()->get("SOAPAction"))['path'], "/");
    }
}
