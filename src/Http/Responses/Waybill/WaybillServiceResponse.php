<?php

declare(strict_types=1);

namespace RS\Http\Responses\Waybill;

use Saloon\Http\Response;

abstract class WaybillServiceResponse extends Response
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
