<?php

declare(strict_types=1);

namespace RS\Services;

use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\SoapApiRequestHeader;
use Saloon\XmlWrangler\Data\Element;
use RS\Http\Connectors\WaybillServiceConnector;
use RS\Http\Requests\Waybill\GetWaybillRequest;
use RS\XmlElements\ServiceUserCredentialsElement;
use RS\Http\Requests\Waybill\GetExciseCodesRequest;
use RS\Http\Requests\Waybill\GetWaybillTypesRequest;
use RS\Http\Requests\Waybill\CheckServiceUserRequest;

final class WaybillService
{
    /**
     * Declare params __construct
     * @param \RS\Http\Connectors\WaybillServiceConnector $connector
     */
    public function __construct(
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
    /**
     * Retrieve excise codes
     * @param \RS\Http\Requests\Waybill\GetExciseCodesRequest $request
     * @return array
     */
    public function getExciseCodes(GetExciseCodesRequest $request = new GetExciseCodesRequest()): array
    {
        return $this->connector->send($request)->parsed();
    }
    /**
     * Retrieve waybill types
     * @param \RS\Http\Requests\Waybill\GetWaybillTypesRequest $request
     * @return array
     */
    public function getWaybillTypes(GetWaybillTypesRequest $request = new GetWaybillTypesRequest()): array
    {
        return $this->connector->send($request)->parsed();
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
