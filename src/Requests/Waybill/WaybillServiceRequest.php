<?php

namespace RS\Requests\Waybill;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\XmlWrangler\XmlWriter;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasXmlBody;
use Saloon\XmlWrangler\Data\Element;
use Saloon\XmlWrangler\Data\RootElement;
use RS\Requests\Waybill\BodyElements\ServiceUserCredentialsElement;

abstract class WaybillServiceRequest extends Request implements HasBody
{
    use HasXmlBody;

    protected Method $method = Method::POST;
    /**
     * RS Service Operation name
     * as declared in their documentation
     * @var string $SOAPAction
     */
    protected string $SOAPAction;
    protected string $SOAPActionUrl = "http://tempuri.org/";
    protected array $xmlNamespaces = [
        "xmlns:xsi" => "http://www.w3.org/2001/XMLSchema-instance",
        "xmlns:xsd" => "http://www.w3.org/2001/XMLSchema",
        "xmlns:soap" => "http://schemas.xmlsoap.org/soap/envelope/",
    ];


    public function resolveEndpoint(): string
    {
        return '/';
    }

    protected function defaultHeaders(): array
    {
        return [
            "SOAPAction" => $this->SOAPActionUrl . $this->SOAPAction,
        ];
    }

    protected function defaultBody(): string
    {
        $xml = XmlWriter::make()->write(
            $this->defaultRootElement(),
            [
                "soap:Body" => $this->defaultBodyElements()
            ]
        );
        return $xml;
    }

    public function defaultRootElement(): RootElement
    {
        return (new RootElement("soap:Envelope"))->setAttributes(
            $this->xmlNamespaces
        )->addAttribute("xmlns", $this->SOAPActionUrl);
    }

    public function defaultBodyElements(): Element
    {
        return Element::make([
            $this->SOAPAction => (new ServiceUserCredentialsElement)->addAttribute("xmlns", $this->SOAPActionUrl),
        ]);
    }

    public function beforeSend(): void
    {
        $this->headers()->add("Content-Length", strlen($this->body()));
    }
}
