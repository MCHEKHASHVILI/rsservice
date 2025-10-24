<?php

use RS\Requests\Waybill\CheckServiceUserRequest;
use RS\Connectors\WaybillServiceConnector;
use RS\Requests\Waybill\GetExciseCodesRequest;
use RS\Requests\Waybill\GetWaybillRequest;
use RS\Requests\Waybill\GetWaybillTypesRequest;

beforeEach(fn() => $this->connector = new WaybillServiceConnector());

describe('CheckServiceUserRequest:', function () {
    beforeEach(fn() => $this->request = new CheckServiceUserRequest());
    test("getting response true", function () {
        expect($this->connector->send($this->request)->parsed())->toBeTrue("some error occured");
    });
});

describe('GetExciseCodesRequest:', function () {
    beforeEach(fn() => $this->request = new GetExciseCodesRequest());
    test("response returns array", function () {
        expect($this->connector->send($this->request)->parsed())->toBeArray("Result must be array");
    });
});

describe('GetWaybillTypesRequest:', function () {
    beforeEach(fn() => $this->request = new GetWaybillTypesRequest());
    test("response returns array", function () {
        // dd($this->response->xmlReader()->values());
        expect($this->connector->send($this->request)->parsed())->toBeArray("Result must be array");
    });
});

// describe('GetWaybillRequest:', function () {
//     beforeEach(fn() => $this->request = new GetWaybillRequest());

//     test("response returns array", function () {
//         // dd($this->response->xmlReader()->values());
//         expect(
//             $this->response
//                 ->xmlReader()
//                 ->value("soap:Envelope.soap:Body.{$this->request->getOperation()}Response")
//                 ->sole()["{$this->request->getOperation()}Result"]
//         )->toBeArray("Result must be array");
//     });
// });