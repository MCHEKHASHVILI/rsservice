<?php

use RS\Services\WaybillService;
use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\SoapApiRequestHeader;
use Saloon\XmlWrangler\Data\Element;
use RS\Http\Requests\Waybill\CheckServiceUserRequest;
use Saloon\Exceptions\Request\Statuses\UnauthorizedException;

beforeEach(fn() => $this->service = new WaybillService());

describe("Check Service User:", function () {
    describe("Valid Credentials:", function () {
        test("Returns true", function () {
            expect($this->service->serviceUserIsRegistered())->toBeTrue("Service User is not Registered");
        });
        test("S_USER_ID is set", function () {
            expect($this->service->getServiceUserId())->toBeGreaterThan(0, "Service user S_USER_ID is not set");
        });
        test("UN_ID is set", function () {
            expect($this->service->getPayersId())->toBeGreaterThan(0, "Payers UN_ID is not set");
        });
    });
    describe("Invalid Credentials:", function () {
        beforeEach(function () {
            $this->request = new CheckServiceUserRequest();
            $this->request->body()->set(XmlWriter::make()->write(
                $this->request->defaultRootElement(),
                [
                    "soap:Body" => [
                        $this->request->action => Element::make()
                            ->setContent([
                                "su" => "invalid_su",
                                "sp" => "invalid_sp",
                            ])
                            ->addAttribute("xmlns", SoapApiRequestHeader::ACTION_URL->value)
                    ]
                ]
            ));
        });

        it("throws \Saloon\Exceptions\Request\Statuses\UnauthorizedException on Invalid Credentials", function () {
            $this->service->serviceUserIsRegistered($this->request);
        })->throws(UnauthorizedException::class);
    });
});

describe('Get Excise Codes:', function () {
    test("got array of excise codes", function () {
        expect($this->service->getExciseCodes())->toBeArray("Result must be array");
    });
});

describe('Get Waybill Types:', function () {
    test("got array of waybill types", function () {
        expect($this->service->getWaybillTypes())->toBeArray("Result must be array");
    });
});

describe('Retrieve waybill:', function () {
    test("retrieves waybill by id", function () {
        expect($this->service->getWaybillByID(123456))->toBeArray("Result must be array");
    });
});
