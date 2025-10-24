<?php

declare(strict_types=1);

namespace RS\Http\Requests\Waybill;

use Throwable;
use Saloon\Http\Response;
use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\SoapApiRequestHeader;
use RS\XmlElements\ServiceUserCredentialsElement;
use RS\Http\Requests\Waybill\WaybillServiceRequest;
use RS\Http\Responses\Waybill\CheckServiceUserResponse;
use Saloon\Exceptions\Request\Statuses\UnauthorizedException;

class CheckServiceUserRequest extends WaybillServiceRequest
{
    protected ?string $response = CheckServiceUserResponse::class;


    public function __construct(
        /**
         * RS Service Operation name
         * as declared in their documentation
         * @var string $action
         */
        public readonly string $action = "chek_service_user"
    ) {}

    public function hasRequestFailed(Response $response): ?bool
    {
        return ! $response->isRegistered();
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        return new UnauthorizedException($response, 'Invalid Service User Credentials', 401, $senderException);
    }

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
