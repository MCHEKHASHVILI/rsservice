<?php

namespace RS\Http\Requests\Waybill;

use Throwable;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use RS\Enums\SoapUserCredentials;
use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\SoapApiRequestHeader;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasXmlBody;
use RS\Enums\SoapEnvelopeNamespace;
use Saloon\XmlWrangler\Data\Element;
use Saloon\XmlWrangler\Data\RootElement;
use RS\Enums\Actions\WaybillServiceAction;
use RS\XmlElements\ServiceUserCredentialsElement;
use RS\Http\Responses\Waybill\WaybillServiceResponse;
use Saloon\Exceptions\Request\Statuses\NotFoundException;

class WaybillServiceRequest extends Request implements HasBody
{
    use HasXmlBody;

    protected Method $method = Method::POST;

    public function __construct(
        public readonly WaybillServiceAction $action,
        protected ?string $response = WaybillServiceResponse::class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/';
    }
    protected function defaultHeaders(): array
    {
        return [
            "SOAPAction" => SoapApiRequestHeader::ACTION_URL->value . $this->action->getActionName(),
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
                    $this->action->getActionName() => (new ServiceUserCredentialsElement)
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
     * Generate request body using credentials Enum and array of body elements 
     * @param \RS\Enums\SoapUserCredentials $soapUserCredentials
     * @param array $body
     * @return array
     */
    public function generateBodyElement(SoapUserCredentials $soapUserCredentials, array $body = []): array
    {
        $element = [
            "soap:Body" => [
                $this->action->getActionName() => Element::make(
                    array_merge(
                        (new $soapUserCredentials->value)->getContent(),
                        $body,
                    )
                )->addAttribute("xmlns", SoapApiRequestHeader::ACTION_URL->value)
            ]
        ];
        return $element;
    }

    public function hasRequestFailed(Response $response): ?bool
    {
        return ! $response->resourceRetrieved();
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        return new NotFoundException($response, 'resounrce not found', 404, $senderException);
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
