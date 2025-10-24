<?php

namespace Mchekhashvili\Rsservice\Requests\WaybillServiceRequests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\XmlWrangler\XmlWriter;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasXmlBody;
use Saloon\XmlWrangler\Data\Element;
use Saloon\XmlWrangler\Data\RootElement;

abstract class WaybillServiceRequest extends Request implements HasBody
{
    use HasXmlBody;

    protected Method $method = Method::POST;
    /**
     * RS Service Operation name
     * as declared in their documentation
     * @var string $operation
     */
    protected string $operation;

    public function resolveEndpoint(): string
    {
        return '/';
    }

    protected function defaultHeaders(): array
    {
        return [
            "SOAPAction" => "http://tempuri.org/{$this->operation}",
        ];
    }

    protected function defaultBody(): string
    {
        $xml = XmlWriter::make()->write(
            (new RootElement("soap:Envelope"))->setAttributes(
                [
                    "xmlns:xsi" => "http://www.w3.org/2001/XMLSchema-instance",
                    "xmlns:xsd" => "http://www.w3.org/2001/XMLSchema",
                    "xmlns:soap" => "http://schemas.xmlsoap.org/soap/envelope/",
                ]
            ),
            [
                "soap:Body" => Element::make([
                    'chek_service_user' => Element::make([
                        "su" => "rsserviceuser:206322102",
                        "sp" => "Password123!@#",
                    ])->addAttribute("xmlns", "http://tempuri.org/")
                ])
            ]
        );

        $this->headers()->add("Content-Length", strlen($xml));

        return $xml;
    }

    /**
     * Retrieve Operation Name
     * @return string
     */
    public function getOperation()
    {
        return $this->operation;
    }
}
