<?php

declare(strict_types=1);

namespace RS\Http\Responses\Waybill;

use RS\Http\Responses\Waybill\WaybillServiceResponse;


class GetWaybillResponse extends WaybillServiceResponse
{

    /**
     * Check if resourse is retrieved
     * @return bool
     */
    public function resourceRetrieved(): bool
    {
        return !($this->getResponseStatusCode() < 0);
    }

    /**
     * Get Exact status code from response
     * 0 means success
     * @return int
     */
    public function getResponseStatusCode(): int
    {
        return (int) (parent::parsed()[$this->getSOAPAction() . "Result"]["RESULT"]["STATUS"] ?? 0);
    }

    public function parsed(): array
    {
        return parent::parsed()[$this->getSoapAction() . "Result"]["WAYBILL"];
    }
}
