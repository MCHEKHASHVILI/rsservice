<?php

declare(strict_types=1);

namespace RS\Http\Responses\Waybill;

use Saloon\Http\Response;
use Saloon\Http\PendingRequest;
use RS\Http\Requests\Waybill\WaybillServiceRequest;

class WaybillServiceResponse extends Response
{
    public function parsed(): array
    {
        $parsed = $this->xmlReader()
            ->value("soap:Envelope.soap:Body")
            ->sole();

        /** @var WaybillServiceRequest $request */
        $request = $this->pendingRequest->getRequest();

        $response_keys = $request->action->getResponsePathArray();

        $parsed = array_reduce($response_keys, fn($initial, $key) => $initial[$key] ?? [], $parsed);

        return $parsed;
    }

    protected function getSOAPAction(): string
    {
        return trim(parse_url($this->pendingRequest->headers()->get("SOAPAction"))['path'], "/");
    }

    /**
     * Check if resourse is retrieved
     * @return bool
     */
    public function resourceRetrieved(): bool
    {
        /**
         * @todo better implementation needed like pipelines.
         * Declaration of status codes with status code description
         * Each status code must throw proper Exception not only 404
         */
        $errorResult = $this->parseError();

        return
            gettype($errorResult) === "array" // errorParserKeys are not implemented in WaybillServiceAction 
            || strtolower($errorResult) === "true"
            || $errorResult === null
            || (bool) $errorResult === false;
    }

    /**
     * Summary of parseError
     * @return mixed
     */
    public function parseError(): mixed
    {
        $parsed = $this->xmlReader()
            ->value("soap:Envelope.soap:Body")
            ->sole();
        /** @var WaybillServiceRequest $request */
        $request = $this->pendingRequest->getRequest();

        $response_keys = $request->action->getErrorResponsePathArray();

        $parsed = array_reduce($response_keys, fn($initial, $key) => $initial[$key] ?? [], $parsed);
        // dd($parsed);
        return $parsed;
    }

    /**
     * Get Exact status code from response
     * 0 means success
     * @return int
     */
    public function getResponseStatusCode(): int
    {
        return (int) ($this->xmlReader()
            ->value("soap:Envelope.soap:Body.{$this->getSOAPAction()}Response.{$this->getSOAPAction()}Result")
            ->sole()["RESULT"]["STATUS"] ?? 0);
    }

    /**
     * Retrieve Pending request for Testing Purpose
     * @return PendingRequest
     */
    public function getPendingRequest(): PendingRequest
    {
        return $this->pendingRequest;
    }
}
