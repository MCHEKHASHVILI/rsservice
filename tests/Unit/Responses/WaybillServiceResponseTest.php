<?php

use RS\Enums\SoapUserCredentials;
use Saloon\XmlWrangler\XmlWriter;
use RS\Enums\Actions\WaybillServiceAction;
use RS\Http\Connectors\WaybillServiceConnector;
use RS\Http\Requests\Waybill\WaybillServiceRequest;
use RS\Http\Responses\Waybill\WaybillServiceResponse;
use Saloon\Exceptions\Request\Statuses\NotFoundException;

beforeEach(fn() => $this->connector = new WaybillServiceConnector());

describe("CHECK_SERVICE_USER", function () {
    describe("invalid credentials", function () {
        it("trows " . NotFoundException::class, function () {
            $request = new WaybillServiceRequest(WaybillServiceAction::CHECK_SERVICE_USER);
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
            $this->connector->send($request);
        })->throws(NotFoundException::class);
    });
    describe("valid credentials", function () {
        test("response returned after request is sent", function () {
            expect($this->connector->send(new WaybillServiceRequest(WaybillServiceAction::CHECK_SERVICE_USER)))
                ->toBeInstanceOf(WaybillServiceResponse::class);
        });

        test("response can access the proper requst object back", function () {
            expect($this->connector->send(new WaybillServiceRequest(WaybillServiceAction::CHECK_SERVICE_USER))->getPendingRequest()->getRequest())
                ->toBeInstanceOf(WaybillServiceRequest::class);
        });

        test("retrieved request object has the proper property {action}", function () {
            expect($this->connector->send(new WaybillServiceRequest(WaybillServiceAction::CHECK_SERVICE_USER))->getPendingRequest()->getRequest()->action)
                ->toBeInstanceOf(WaybillServiceAction::class);
        });

        test("{action} can retrieve actionName", function () {
            expect($this->connector->send(new WaybillServiceRequest(WaybillServiceAction::CHECK_SERVICE_USER))->getPendingRequest()->getRequest()->action->getActionName())
                ->toEqual("chek_service_user");
        });

        test("{action} can retrieve responsePath", function () {
            expect($this->connector->send(new WaybillServiceRequest(WaybillServiceAction::CHECK_SERVICE_USER))->getPendingRequest()->getRequest()->action->getResponsePath())
                ->toEqual("chek_service_userResponse");
        });
        test("{action} can retrieve responsePathArray", function () {
            expect($this->connector->send(new WaybillServiceRequest(WaybillServiceAction::CHECK_SERVICE_USER))->getPendingRequest()->getRequest()->action->getResponsePathArray())
                ->toEqual(["chek_service_userResponse"]);
        });
    });
});
describe("GET_ERROR_CODES", function () {
    describe("invalid credentials", function () {
        it("trows " . NotFoundException::class, function () {
            $request = new WaybillServiceRequest((WaybillServiceAction::GET_ERROR_CODES));
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
            $response = $this->connector->send($request);
        })->throws(NotFoundException::class);
    });
    describe("valid credentials", function () {
        test("response returned after request is sent", function () {
            expect($this->connector->send(new WaybillServiceRequest(WaybillServiceAction::GET_ERROR_CODES)))->toBeInstanceOf(WaybillServiceResponse::class);
        });
    });
});
