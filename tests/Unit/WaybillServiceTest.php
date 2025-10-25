<?php

use RS\Services\WaybillService;
use RS\Enums\SoapUserCredentials;
use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\Actions\WaybillServiceAction;
use RS\Http\Requests\Waybill\WaybillServiceRequest;
use RS\Http\Requests\Waybill\WaybillServiceAuthRequest;
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
        it("throws \Saloon\Exceptions\Request\Statuses\UnauthorizedException on Invalid Credentials", function () {
            $request = new WaybillServiceAuthRequest(WaybillServiceAction::CHECK_SERVICE_USER);
            $request->body()->set(
                XmlWriter::make()->write(
                    $request->defaultRootElement(),
                    $request->generateBodyElement(
                        SoapUserCredentials::SERVICE_USER,
                        [
                            "su" => "invalid_username",
                            "sp" => "invalid_password",
                        ]
                    ),
                )
            );
            $this->service->checkServiceUser($request);
        })->throws(UnauthorizedException::class);
    });
});

describe("Retrieving reference information", function () {
    test("error codes", function () {
        $result = $this->service->getErrorCodes();
        expect($result)->toBeArray("Result must be array");
        expect(array_keys($result[0]))->toBeArray("Result must be array");
    });
    test("excise codes", function () {
        $result = $this->service->getExciseCodes();
        expect($result)->toBeArray("Result must be array");
        expect(array_keys($result[0]))->toContain("ID");
    });
    test("waybill types", function () {
        $result = $this->service->getWaybillTypes();
        expect($result)->toBeArray("Result must be array");
        expect(array_keys($result[0]))->toContain("ID");
    });
    test("wood types", function () {
        $result = $this->service->getWoodTypes();
        expect($result)->toBeArray("Result must be array");
        expect(array_keys($result[0]))->toContain("ID");
    });
    test("transportation types", function () {
        $result = $this->service->getTransportationTypes();
        expect($result)->toBeArray("Result must be array");
        expect(array_keys($result[0]))->toContain("ID");
    });
    test("waybill units", function () {
        $result = $this->service->getWaybillUnits();
        expect($result)->toBeArray("Result must be array");
        expect(array_keys($result[0]))->toContain("ID");
    });
});

describe('Retrieve waybill:', function () {
    describe("by id:", function () {
        test("valid id", function () {
            $result = $this->service->getWaybillById('975534966');
            expect($result)->toBeArray("Result must be array");
            expect(array_keys($result))->toContain("ID", "WAYBILL_NUMBER");
        });
        it("throws \Saloon\Exceptions\Request\Statuses\NotFoundException on invalid id", function () {
            $this->service->getWaybillById('1234567890');
        })->throws(NotFoundException::class);
    });
    describe("by waybill number:", function () {
        test("valid number", function () {
            $result = $this->service->getWaybillByNumber('0935463264');
            expect($result)->toBeArray("Result must be array");
            expect(array_keys($result))->toContain("ID", "WAYBILL_NUMBER");
        });
        it("throws \Saloon\Exceptions\Request\Statuses\NotFoundException on invalid number", function () {
            $this->service->getWaybillByNumber('1234567890');
        })->throws(NotFoundException::class);
    });
});

define("retrieve waybills", function () {
    define("get all waybills", function () {
        test("valid credentials", function () {
            expect($this->service->getWaybills())->toBeArray("Expected Array of waybills");
        });
        it("invalid credentials", function () {
            $request = new WaybillServiceRequest(WaybillServiceAction::GET_WAYBILLS);
            $request->body()->set(
                XmlWriter::make()->write(
                    $request->defaultRootElement(),
                    $request->generateBodyElement(
                        SoapUserCredentials::SERVICE_USER,
                        [
                            "su" => "invalid_username",
                            "sp" => "invalid_password",
                        ]
                    ),
                )
            );
            $this->service->getWaybills($request);
        })->throws(NotFoundException::class);
    });
});
