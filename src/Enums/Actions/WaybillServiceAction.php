<?php

declare(strict_types=1);

namespace RS\Enums\Actions;

/**
 * Summary of WaybillServiceAction
 */
enum WaybillServiceAction: string
{
    case CHECK_SERVICE_USER = "chek_service_user|chek_service_userResponse|chek_service_userResponse.chek_service_userResult";
    case GET_ERROR_CODES = "get_error_codes|get_error_codesResponse.get_error_codesResult.ERROR_CODES.ERROR_CODE|get_error_codesResponse.get_error_codesResult.RESULT.STATUS";
    case GET_EXCISE_CODES = "get_akciz_codes|get_akciz_codesResponse.get_akciz_codesResult.AKCIZ_CODES.AKCIZ_CODE";
    case GET_WAYBILL_TYPES = "get_waybill_types|get_waybill_typesResponse.get_waybill_typesResult.WAYBILL_TYPES.WAYBILL_TYPE";
    case GET_WOOD_TYPES = "get_wood_types|get_wood_typesResponse.get_wood_typesResult.WOOD_TYPES.WOOD_TYPE";
    case GET_TRANSPORTATION_TYPES = "get_trans_types|get_trans_typesResponse.get_trans_typesResult.TRANSPORT_TYPES.TRANSPORT_TYPE";
    case GET_WAYBILL_UNITS = "get_waybill_units|get_waybill_unitsResponse.get_waybill_unitsResult.WAYBILL_UNITS.WAYBILL_UNIT";
    case GET_WAYBILLS = "get_waybills|get_waybillsResponse.get_waybillsResult.WAYBILL_LIST.WAYBILL";
    case GET_WAYBILL = "get_waybill|get_waybillResponse.get_waybillResult.WAYBILL|get_waybillResponse.get_waybillResult.RESULT.STATUS";
    case GET_WAYBILL_BY_NUMBER = "get_waybill_by_number|get_waybill_by_numberResponse.get_waybill_by_numberResult.WAYBILL|get_waybill_by_numberResponse.get_waybill_by_numberResult.RESULT.STATUS";

    public function getActionName(): string
    {
        return explode('|', $this->value)[0] ?? '';
    }

    public function getResponsePath(): string
    {
        return explode('|', $this->value)[1] ?? '';
    }

    public function getResponsePathArray(): array
    {

        if (! (bool) $this->getResponsePath()) {
            return [];
        }
        return explode(".", $this->getResponsePath());
    }

    public function getErrorResponsePath(): string
    {
        return explode('|', $this->value)[2] ?? '';
    }

    public function getErrorResponsePathArray(): array
    {
        if (! (bool) $this->getErrorResponsePath()) {
            return [];
        }
        return explode(".", $this->getErrorResponsePath());
    }
}
