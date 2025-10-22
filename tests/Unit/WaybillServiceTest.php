<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Mchekhashvili\Rsservice\Dtos\ServiceUserDto;
use Mchekhashvili\Rsservice\Services\WaybillService;
use Mchekhashvili\Rsservice\Connections\SoapConnection;
use Mchekhashvili\Rsservice\Contracts\ConnectionContract;
use Mchekhashvili\Rsservice\Dtos\MainUserDto;

class WaybillServiceTest extends TestCase
{
    protected string $wsdl;
    protected string $userName;
    protected string $userPassword;
    protected ConnectionContract $connection;
    protected MainUserDto $mainUserDto;
    protected ServiceUserDto $serviceUserDto;
    protected WaybillService $waybillService;

    protected function setUp(): void
    {
        $this->wsdl = "https://services.rs.ge/WayBillService/WayBillService.asmx?WSDL";
        $this->connection = new SoapConnection($this->wsdl);
        $this->mainUserDto = new MainUserDto("tbilisi", "123456");
        $this->serviceUserDto = new ServiceUserDto("rsserviceuser:206322102", "Password123!@#");
        $this->waybillService = new WaybillService($this->connection);
    }
    public function test_waybill_service_can_get_all_service_users()
    {
        $checked = $this->waybillService->checkServiceUser($this->serviceUserDto);
        // dd($checked);
        // $this->assertIsBool($waybillService->checkServiceUser($serviceUser));
    }

    public function test_waybill_service_can_check_service_user()
    {
        $users = $this->waybillService->getServiceUsers($this->mainUserDto);
        dd($users, "there");
        // $this->assertIsBool($waybillService->checkServiceUser($serviceUser));
    }

    public function test_waybill_service_can_get_error_codes()
    {
        // $errorCodes = $this->waybillService->getErrorCodes($this->serviceUserDto);
        // $errorCodes = $this->connection->client->__soapCall("chek_service_user", ['su' => 'RSSERVICEUSER:206322102', 'sp' => 'Password123!@#']);

        // dd($errorCodes, "here");
    }
}
