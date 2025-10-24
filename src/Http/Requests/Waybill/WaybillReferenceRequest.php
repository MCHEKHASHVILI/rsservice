<?php

namespace RS\Http\Requests\Waybill;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\SoapApiRequestHeader;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasXmlBody;
use RS\Enums\SoapEnvelopeNamespace;
use Saloon\XmlWrangler\Data\RootElement;
use RS\Enums\Actions\WaybillServiceAction;
use RS\Http\Responses\Waybill\WaybillReferenceResponse;
use RS\XmlElements\ServiceUserCredentialsElement;

class WaybillReferenceRequest extends Request implements HasBody
{
    use HasXmlBody;

    protected Method $method = Method::POST;

    public function __construct(
        public readonly WaybillServiceAction $action,
        protected ?string $response = WaybillReferenceResponse::class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/';
    }

    protected function defaultHeaders(): array
    {
        return [
            "SOAPAction" => SoapApiRequestHeader::ACTION_URL->value . $this->action->value,
        ];
    }

    /**
     * Setting default body to request
     * @return string
     */
    protected function defaultBody(): string
    {
        $xml = XmlWriter::make()->write(
            $this->defaultRootElement(),
            [
                "soap:Body" => [
                    $this->action->value => (new ServiceUserCredentialsElement)
                        ->addAttribute("xmlns", SoapApiRequestHeader::ACTION_URL->value)
                ]
            ]
        );
        return $xml;
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
