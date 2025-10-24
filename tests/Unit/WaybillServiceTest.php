<?php

use Mchekhashvili\Rsservice\Requests\WaybillServiceRequests\CheckServiceUserRequest;
use Mchekhashvili\Rsservice\Connectors\WaybillServiceConnector;
use Mchekhashvili\Rsservice\Requests\WaybillServiceRequests\GetExciseCodesRequest;
use Mchekhashvili\Rsservice\Requests\WaybillServiceRequests\GetWaybillTypesRequest;

beforeEach(fn() => $this->connector = new WaybillServiceConnector());

describe('CheckServiceUserRequest:', function () {
    beforeEach(fn() => $this->request = new CheckServiceUserRequest());
    test("getting response true", function () {
        expect(($this->connector)
                ->send($this->request)
                ->xmlReader()
                ->value("soap:Envelope.soap:Body.{$this->request->getOperation()}Response")
                ->sole()["{$this->request->getOperation()}Result"]
        )->toBe("true", "some error occured");
    });
});

describe('GetExciseCodesRequest:', function () {
    beforeEach(fn() => $this->request = new GetExciseCodesRequest());
    test("response returns array", function () {
        expect(($this->connector)
                ->send($this->request)
                ->xmlReader()
                ->value("soap:Envelope.soap:Body.{$this->request->getOperation()}Response")
                ->sole()["{$this->request->getOperation()}Result"]
        )->toBeArray("Result must be array");
    });
});

describe('GetWaybillTypesRequest:', function () {
    beforeEach(fn() => $this->request = new GetWaybillTypesRequest());
    test("response returns array", function () {
        expect(($this->connector)
                ->send($this->request)
                ->xmlReader()
                ->value("soap:Envelope.soap:Body.{$this->request->getOperation()}Response")
                ->sole()["{$this->request->getOperation()}Result"]
        )->toBeArray("Result must be array");
    });
});
