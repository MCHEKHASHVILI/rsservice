<?php

namespace RS\Requests\Waybill;

class GetWaybillRequest extends WaybillServiceRequest
{
    protected string $SOAPAction = "get_waybill";
}
