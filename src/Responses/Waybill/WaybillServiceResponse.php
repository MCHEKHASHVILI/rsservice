<?php

declare(strict_types=1);

namespace RS\Responses\Waybill;

use Saloon\Http\Response;

abstract class WaybillServiceResponse extends Response
{
    protected $SOAPActionPrefix = "http://tempuri.org/";
    public function parsed(): mixed
    {
        return $this->xmlReader()
            ->value("soap:Envelope.soap:Body.{$this->getSOAPAction()}Response")
            ->sole()["{$this->getSOAPAction()}Result"];
    }

    protected function getSOAPAction(): string
    {
        return trim(parse_url($this->pendingRequest->headers()->get("SOAPAction"))['path'], "/");
    }
}
