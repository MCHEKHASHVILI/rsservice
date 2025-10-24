<?php

declare(strict_types=1);

namespace RS\Services;

use RS\Traits\HasReferences;
use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\SoapApiRequestHeader;
use Saloon\XmlWrangler\Data\Element;
use RS\Http\Connectors\WaybillServiceConnector;
use RS\Http\Requests\Waybill\GetWaybillRequest;
use RS\XmlElements\ServiceUserCredentialsElement;
use RS\Http\Requests\Waybill\CheckServiceUserRequest;

final class WaybillService
{
    use HasReferences;
    public function __construct(
        /**
         * Declare params __construct
         * @param \RS\Http\Connectors\WaybillServiceConnector $connector
         */
        protected readonly WaybillServiceConnector $connector = new WaybillServiceConnector()
    ) {}

    /**
     * Check if the service user is registered
     * @param \RS\Http\Requests\Waybill\CheckServiceUserRequest $request
     * @return bool
     */
    public function serviceUserIsRegistered(CheckServiceUserRequest $request = new CheckServiceUserRequest()): bool
    {
        return $this->connector->send($request)->isRegistered();
    }

    /**
     * Retrieve Service User ID
     * @param \RS\Http\Requests\Waybill\CheckServiceUserRequest $request
     * @return int
     */
    public function getServiceUserId(CheckServiceUserRequest $request = new CheckServiceUserRequest()): int
    {
        return $this->connector->send($request)->getServiceUserId();
    }

    /**
     * Retriewe payer's UN_ID
     * @param \RS\Http\Requests\Waybill\CheckServiceUserRequest $request
     * @return int
     */
    public function getPayersId(CheckServiceUserRequest $request = new CheckServiceUserRequest()): int
    {
        return $this->connector->send($request)->getPayersUnId();
    }



    public function getWaybillById(string $waybillId, GetWaybillRequest $request = new GetWaybillRequest())
    {
        $request->body()->set(XmlWriter::make()->write(
            $request->defaultRootElement(),
            [
                "soap:Body" => [
                    $request->action => Element::make(
                        array_merge(
                            (new ServiceUserCredentialsElement())->getContent(),
                            ["waybill_id" => $waybillId]
                        )
                    )->addAttribute("xmlns", SoapApiRequestHeader::ACTION_URL->value)

                ]
            ]
        ));

        return $this->connector->send($request)->parsed();
    }

    public function getWaybillByNumber(string $number, GetWaybillRequest $request = new GetWaybillRequest("get_waybill_by_number"))
    {
        $request->body()->set(XmlWriter::make()->write(
            $request->defaultRootElement(),
            [
                "soap:Body" => [
                    $request->action => Element::make(
                        array_merge(
                            (new ServiceUserCredentialsElement())->getContent(),
                            ["waybill_number" => $number]
                        )
                    )->addAttribute("xmlns", SoapApiRequestHeader::ACTION_URL->value)

                ]
            ]
        ));

        return $this->connector->send($request)->parsed();
    }
}
