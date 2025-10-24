<?php

declare(strict_types=1);

namespace RS\Http\Responses\Waybill;

use Saloon\Http\Response;
use RS\Enums\Actions\WaybillServiceAction;
use RS\Enums\Response\WaybillResponsePath;

class WaybillReferenceResponse extends Response
{
    public function parsed(): mixed
    {
        $keys = explode(".", constant(WaybillResponsePath::class . "::" . WaybillServiceAction::from($this->getSOAPAction())->name)->value);
        return $this->xmlReader()
            ->value("soap:Envelope.soap:Body.{$this->getSOAPAction()}Response.{$this->getSOAPAction()}Result")
            ->sole()[$keys[0]][$keys[1]];
    }

    protected function getSOAPAction(): string
    {
        return trim(parse_url($this->pendingRequest->headers()->get("SOAPAction"))['path'], "/");
    }
}
