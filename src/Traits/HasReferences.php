<?php

declare(strict_types=1);

namespace RS\Traits;

use RS\Enums\Actions\WaybillServiceAction;
use RS\Http\Connectors\WaybillServiceConnector;
use RS\Http\Requests\Waybill\WaybillReferenceRequest;

trait HasReferences
{
    protected readonly WaybillServiceConnector $connector;
    /**
     * Retrieve error codes
     * @param \RS\Http\Requests\Waybill\WaybillReferenceRequest $request
     * @return array
     */
    public function getErrorCodes(WaybillReferenceRequest $request = new WaybillReferenceRequest(WaybillServiceAction::GET_ERROR_CODES)): array
    {
        return $this->connector->send($request)->parsed();
    }

    /**
     * Retrieve excise codes
     * @param \RS\Http\Requests\Waybill\WaybillReferenceRequest $request
     * @return array
     */
    public function getExciseCodes(WaybillReferenceRequest $request = new WaybillReferenceRequest(WaybillServiceAction::GET_EXCISE_CODES)): array
    {
        return $this->connector->send($request)->parsed();
    }
    /**
     * Retrieve waybill types
     * @param \RS\Http\Requests\Waybill\WaybillReferenceRequest $request
     * @return array
     */
    public function getWaybillTypes(WaybillReferenceRequest $request = new WaybillReferenceRequest(WaybillServiceAction::GET_WAYBILL_TYPES)): array
    {
        return $this->connector->send($request)->parsed();
    }

    /**
     * Retrieve waybill types
     * @param \RS\Http\Requests\Waybill\WaybillReferenceRequest $request
     * @return array
     */
    public function getWaybillUnits(WaybillReferenceRequest $request = new WaybillReferenceRequest(WaybillServiceAction::GET_WAYBILL_UNITS)): array
    {
        return $this->connector->send($request)->parsed();
    }

    /**
     * Retrieve transportation types
     * @param \RS\Http\Requests\Waybill\WaybillReferenceRequest $request
     * @return array
     */
    public function getTransportationTypes(WaybillReferenceRequest $request = new WaybillReferenceRequest(WaybillServiceAction::GET_TRANSPORTATION_TYPES)): array
    {
        return $this->connector->send($request)->parsed();
    }
    /**
     * Retrieve transportation types
     * @param \RS\Http\Requests\Waybill\WaybillReferenceRequest $request
     * @return array
     */
    public function getWoodTypes(WaybillReferenceRequest $request = new WaybillReferenceRequest(WaybillServiceAction::GET_WOOD_TYPES)): array
    {
        return $this->connector->send($request)->parsed();
    }
}
