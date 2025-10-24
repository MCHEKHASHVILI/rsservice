<?php

namespace RS\Http\Requests\Waybill;

use RS\Enums\SoapApiRequestHeader;
use RS\Enums\SoapEnvelopeNamespace;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasXmlBody;
use Saloon\XmlWrangler\Data\RootElement;

abstract class WaybillServiceRequest extends Request implements HasBody
{
    use HasXmlBody;

    /**
     * RS Service Operation name
     * as declared in their documentation
     * @var string $action
     */
    public readonly string $action;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/';
    }

    protected function defaultHeaders(): array
    {
        return [
            "SOAPAction" => SoapApiRequestHeader::ACTION_URL->value . $this->action,
        ];
    }

    /**
     * Define the root element for the XML body
     * @return RootElement
     */
    public function defaultRootElement(): RootElement
    {
        return (new RootElement("soap:Envelope"))
            ->setNamespaces(SoapEnvelopeNamespace::toArray());
    }

    /**
     * Actions before sending the request
     * @return void
     */
    public function beforeSend(): void
    {
        $this->headers()->add("Content-Length", strlen($this->body()));
    }
}
