<?php

declare(strict_types=1);

namespace RS\Enums\Response;

enum WaybillResponsePath: string
{
    case GET_ERROR_CODES = "Response.Result.ERROR_CODES.ERROR_CODE";
    case GET_EXCISE_CODES = "Response.Result.AKCIZ_CODES.AKCIZ_CODE";
    case GET_WAYBILL_TYPES = "Response.Result.WAYBILL_TYPES.WAYBILL_TYPE";
    case GET_WOOD_TYPES = "Response.Result.WOOD_TYPES.WOOD_TYPE";
    case GET_TRANSPORTATION_TYPES = "Response.Result.TRANSPORT_TYPES.TRANSPORT_TYPE";
    case GET_WAYBILL_UNITS = "Response.Result.WAYBILL_UNITS.WAYBILL_UNIT";
    case GET_WAYBILLS = "Response.Result.WAYBILL_LIST.WAYBILL";
}
