<?php

namespace RS\Http\Requests\Waybill;

use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\SoapApiRequestHeader;
use RS\Http\Responses\Waybill\GetWaybillResponse;
use RS\XmlElements\ServiceUserCredentialsElement;

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

    /**
     * Override in actual request class
     * @return string
     */
    protected function defaultBody(): string
    {
        return XmlWriter::make()->write(
            $this->defaultRootElement(),
            [
                "soap:Body" => [
                    $this->action => (new ServiceUserCredentialsElement)
                        ->addAttribute("xmlns", SoapApiRequestHeader::ACTION_URL->value)
                ]
            ]
        );
    }
}
