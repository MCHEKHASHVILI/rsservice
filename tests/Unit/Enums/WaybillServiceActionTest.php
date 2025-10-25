<?php

use RS\Enums\Actions\WaybillServiceAction;

test(WaybillServiceAction::class . " is enum", function () {
    expect(WaybillServiceAction::class)->toBeEnum();
});

test(WaybillServiceAction::class . " is not empty", function () {
    expect(count(WaybillServiceAction::cases()))->toBeGreaterThan(0, "enum is empty");
});

test(WaybillServiceAction::class . "::CHECK_SERVICE_USER->getActionName() function returns chek_service_user", function () {
    expect(WaybillServiceAction::CHECK_SERVICE_USER->getActionName())->toEqual("chek_service_user");
});

test(WaybillServiceAction::class . "::CHECK_SERVICE_USER->getResponsePath() function returns chek_service_userResponse", function () {
    expect(WaybillServiceAction::CHECK_SERVICE_USER->getResponsePath())->toEqual("chek_service_userResponse");
});

test(WaybillServiceAction::class . "::CHECK_SERVICE_USER->getResponsePathArray() function returns ['chek_service_user']", function () {
    expect(WaybillServiceAction::CHECK_SERVICE_USER->getResponsePathArray())->toEqual(["chek_service_userResponse"]);
});

test(WaybillServiceAction::class . "::CHECK_SERVICE_USER->getErrorResponsePath() function returns chek_service_userResponse.chek_service_userResult", function () {
    expect(WaybillServiceAction::CHECK_SERVICE_USER->getErrorResponsePath())->toEqual("chek_service_userResponse.chek_service_userResult");
});

test(WaybillServiceAction::class . "::CHECK_SERVICE_USER->getErrorResponsePathArray() function returns ['chek_service_userResponse', 'chek_service_userResult']", function () {
    expect(WaybillServiceAction::CHECK_SERVICE_USER->getErrorResponsePathArray())->toEqual(["chek_service_userResponse", "chek_service_userResult"]);
});
