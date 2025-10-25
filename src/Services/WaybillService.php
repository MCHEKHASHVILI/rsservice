<?php

declare(strict_types=1);

namespace RS\Services;

use RS\Traits\HasReferences;
use RS\Enums\SoapUserCredentials;
use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\SoapApiRequestHeader;
use Saloon\XmlWrangler\Data\Element;
use RS\Enums\Actions\WaybillServiceAction;
use RS\Http\Connectors\WaybillServiceConnector;
use RS\XmlElements\ServiceUserCredentialsElement;
use RS\Http\Requests\Waybill\WaybillServiceRequest;
use RS\Http\Requests\Waybill\WaybillServiceAuthRequest;

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
     * Cheking service user
     * @param \RS\Http\Requests\Waybill\WaybillServiceAuthRequest $request
     * @return array
     */
    public function checkServiceUser(WaybillServiceAuthRequest $request = new WaybillServiceAuthRequest(WaybillServiceAction::CHECK_SERVICE_USER)): array
    {
        return $this->connector->send($request)->parsed();
    }

    /**
     * Check if the service user is registered
     * @return bool
     */
    public function serviceUserIsRegistered(): bool
    {
        return strtolower($this->checkServiceUser()[WaybillServiceAction::CHECK_SERVICE_USER->getActionName() . "Result"]) === "true";
    }

    /**
     * Retrieve Service User ID
     * @return int
     */
    public function getServiceUserId(): int
    {
        return (int) $this->checkServiceUser()["s_user_id"];
    }

    /**
     * Retriewe payer's UN_ID
     * @return int
     */
    public function getPayersId(): int
    {
        return (int) $this->checkServiceUser()["un_id"];
    }
    /**
     * Get Waybill by waybill_id
     * @param string $id
     * @param \RS\Http\Requests\Waybill\WaybillServiceRequest $request
     */
    public function getWaybillById(string $id, WaybillServiceRequest $request = new WaybillServiceRequest(WaybillServiceAction::GET_WAYBILL))
    {
        $request->body()->set(XmlWriter::make()->write(
            $request->defaultRootElement(),
            $request->generateBodyElement(
                SoapUserCredentials::SERVICE_USER,
                [
                    "waybill_id" => $id
                ]
            ),
        ));
        return $this->connector->send($request)->parsed();
    }
    /**
     * Get Waybill by waybill_number
     * @param string $number
     * @param \RS\Http\Requests\Waybill\WaybillServiceRequest $request
     */
    public function getWaybillByNumber(string $number, WaybillServiceRequest $request = new WaybillServiceRequest(WaybillServiceAction::GET_WAYBILL_BY_NUMBER))
    {
        $request->body()->set(XmlWriter::make()->write(
            $request->defaultRootElement(),
            $request->generateBodyElement(
                SoapUserCredentials::SERVICE_USER,
                [
                    "waybill_number" => $number
                ]
            ),
        ));
        return $this->connector->send($request)->parsed();
    }

    public function getWaybills(array $waybillTypes = [], WaybillServiceRequest $request = new WaybillServiceRequest(WaybillServiceAction::GET_WAYBILLS))
    {
        return $this->connector->send($request)->parsed();
    }
}
