<?php

declare(strict_types=1);

namespace RS\Enums\Actions;

enum WaybillServiceAction: string
{
    case GET_ERROR_CODES = "get_error_codes";
    case GET_EXCISE_CODES = "get_akciz_codes";
    case GET_WAYBILL_TYPES = "get_waybill_types";
    case GET_WOOD_TYPES = "get_wood_types";
    case GET_TRANSPORTATION_TYPES = "get_trans_types";
    case GET_WAYBILL_UNITS = "get_waybill_units";
}
