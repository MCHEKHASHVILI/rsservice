<?php

declare(strict_types=1);

namespace RS\Http\Responses\Waybill;

use RS\Http\Responses\Waybill\WaybillServiceResponse;

class CheckServiceUserResponse extends WaybillServiceResponse
{
    /**
     * Check if the service user is registered
     * @return bool
     */
    public function isRegistered(): bool
    {
        $parsed = $this->parsed();
        $key = $this->getSOAPAction() . "Result";
        return isset($parsed[$key]) && strtolower((string)$parsed[$key]) === 'true';
    }
    /**
     * Retrieve Service S_USER_ID from the response
     * @return int
     */
    public function getServiceUserId(): int
    {
        return (int) $this->parsed()["s_user_id"] ?? 0;
    }

    /**
     * Retrieve the Payer's UN_ID from the response.
     * @return int
     */
    public function getPayersUnId(): int
    {
        return (int) $this->parsed()["un_id"] ?? 0;
    }
}
