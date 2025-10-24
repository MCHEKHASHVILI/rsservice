<?php

namespace RS\Http\Requests\Waybill;

use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\SoapApiRequestHeader;
use RS\XmlElements\ServiceUserCredentialsElement;
use RS\Http\Requests\Waybill\WaybillServiceRequest;
use RS\Http\Responses\Waybill\GetExciseCodesResponse;

class GetExciseCodesRequest extends WaybillServiceRequest
{
    protected ?string $response = GetExciseCodesResponse::class;
    public function __construct(
        /**
         * RS Service Operation name
         * as declared in their documentation
         * @var string $action
         */
        public readonly string $action = "get_akciz_codes"
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
