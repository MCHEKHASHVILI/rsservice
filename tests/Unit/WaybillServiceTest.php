<?php

use RS\Services\WaybillService;
use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\SoapApiRequestHeader;
use Saloon\XmlWrangler\Data\Element;
use RS\Http\Requests\Waybill\CheckServiceUserRequest;
use Saloon\Exceptions\Request\Statuses\NotFoundException;
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
            $request = new CheckServiceUserRequest();
            $request->body()->set(XmlWriter::make()->write(
                $request->defaultRootElement(),
                [
                    "soap:Body" => [
                        $request->action => Element::make([
                            "su" => "invalid_su",
                            "sp" => "invalid_sp",
                        ])
                            ->addAttribute("xmlns", SoapApiRequestHeader::ACTION_URL->value)
                    ]
                ]
            ));
            $this->request = $request;
        });

        it("throws \Saloon\Exceptions\Request\Statuses\UnauthorizedException on Invalid Credentials", function () {
            $this->service->serviceUserIsRegistered($this->request);
        })->throws(UnauthorizedException::class);
    });
});

describe("Retrieving reference information", function () {
    test("error codes", function () {
        expect($this->service->getErrorCodes())->toBeArray("Result must be array");
    });
    test("excise codes", function () {
        expect($this->service->getExciseCodes())->toBeArray("Result must be array");
    });
    test("waybill types", function () {
        expect($this->service->getWaybillTypes())->toBeArray("Result must be array");
    });
    test("wood types", function () {
        expect($this->service->getWoodTypes())->toBeArray("Result must be array");
    });
    test("transportation types", function () {
        expect($this->service->getTransportationTypes())->toBeArray("Result must be array");
    });
    test("waybill units", function () {
        expect($this->service->getWaybillUnits())->toBeArray("Result must be array");
    });
});

describe('Retrieve waybill:', function () {
    describe("by valid inputs:", function () {
        test("id", function () {
            expect($this->service->getWaybillByID('975534966'))->toBeArray("Result must be array");
        });
        test("number", function () {
            expect($this->service->getWaybillByNumber('0935463264'))->toBeArray("Result must be array");
        });
    });
    describe("by invalid inputs:", function () {
        it("throws \Saloon\Exceptions\Request\Statuses\NotFoundException on invalid id", function () {
            $this->service->getWaybillByID('1234567890');
        })->throws(NotFoundException::class);
        it("throws \Saloon\Exceptions\Request\Statuses\NotFoundException on invalid number", function () {
            $this->service->getWaybillByNumber('1234567890');
        })->throws(NotFoundException::class);
    });
});
