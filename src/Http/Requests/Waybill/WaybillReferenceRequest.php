<?php

namespace RS\Http\Requests\Waybill;

use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\SoapApiRequestHeader;
use RS\XmlElements\ServiceUserCredentialsElement;
use RS\Http\Requests\Waybill\WaybillServiceRequest;

class WaybillReferenceRequest extends WaybillServiceRequest
{
    public function __construct(
        public readonly string $action,
        protected ?string $response
    ) {}

    /**
     * Override in actual request class
     * @return string
     */
    protected function defaultBody(): string
    {
        $xml = XmlWriter::make()->write(
            $this->defaultRootElement(),
            [
                "soap:Body" => [
                    $this->action => (new ServiceUserCredentialsElement)
                        ->addAttribute("xmlns", SoapApiRequestHeader::ACTION_URL->value)
                ]
            ]
        );
        return $xml;
    }
}
