<?php

declare(strict_types=1);

use Mchekhashvili\Rsservice\Dtos\MainUserDto;
use Mchekhashvili\Rsservice\Dtos\ServiceUserDto;
use Mchekhashvili\Rsservice\Services\WaybillService;
use Mchekhashvili\Rsservice\Connections\SoapConnection;
use Mchekhashvili\Rsservice\Contracts\ConnectionContract;

class OldWaybillServiceTest
{
    protected string $wsdl;
    protected string $userName;
    protected string $userPassword;
    protected ConnectionContract $connection;
    protected MainUserDto $mainUserDto;
    protected ServiceUserDto $serviceUserDto;
    protected WaybillService $waybillService;

    // protected function setUp(): void
    // {
    // $this->wsdl = "https://services.rs.ge/WayBillService/WayBillService.asmx?WSDL";
    // $this->connection = new SoapConnection($this->wsdl);
    // $this->mainUserDto = new MainUserDto("tbilisi", "123456");
    // $this->serviceUserDto = new ServiceUserDto("rsserviceuser:206322102", "Password123!@#");
    // $this->waybillService = new WaybillService($this->connection);
    // }
    // public function test_can_get_all_users_and_check_if_we_are_registered()
    // {
    // $users = $this->waybillService->getServiceUsers($this->mainUserDto);
    // $this->assertNotEmpty($users, "There are no users registered");
    // $this->assertArrayHasKey("USER_NAME", $users[0], "expected to have a key USER_NAME");
    // $ourServiceUser = array_filter($users, fn($user) => strtolower($user['USER_NAME'])  === $this->serviceUserDto->su, ARRAY_FILTER_USE_BOTH);
    // $this->assertNotEmpty($ourServiceUser, "Provided service user not in users list");
    // }
    // 
    // public function test_can_check_service_user()
    // {
    // $checked = $this->waybillService->checkServiceUser($this->serviceUserDto);
    // $this->assertIsBool($checked, "Expected Boolean");
    // $this->assertTrue($checked, "service user is not registered");
    // }
    // 
    // public function test_can_get_error_codes()
    // {
    // $errorCodes = $this->waybillService->getErrorCodes($this->serviceUserDto);
    // $this->assertIsArray($errorCodes, "Expected Array");
    // $this->assertNotEmpty($errorCodes, "Result is empty");
    // }
    // 
    // public function test_can_get_my_ip()
    // {
    // $ip = $this->waybillService->getMyIp();
    // $this->assertIsString($ip, "Result is not a string");
    // $this->assertStringContainsString(".", $ip, "There is no dots in returned ip address $ip");
    // }

    // public function test_can_create_waybill()
    // {
    //     $waybillData = [
    //         "WAYBILL" => [
    //             "SUB_WAYBILLS" => [],
    //             "GOODS_LIST" => [
    //                 "GOODS" => [
    //                     [
    //                         "ID" => "5738965748",
    //                         "W_NAME" => "saliami",
    //                         "UNIT_ID" => "5",
    //                         "QUANTITY" => "5",
    //                         "PRICE" => "3",
    //                         "AMOUNT" => "15",
    //                         "BAR_CODE" => [],
    //                         "VAT_TYPE" => "0",
    //                         "STATUS" => "1",
    //                     ],
    //                     [
    //                         "ID" => "5738950939",
    //                         "W_NAME" => "saliami",
    //                         "UNIT_ID" => "5",
    //                         "QUANTITY" => "5",
    //                         "PRICE" => "3",
    //                         "AMOUNT" => "15",
    //                         "BAR_CODE" => [],
    //                         "VAT_TYPE" => "0",
    //                         "STATUS" => "1",
    //                     ],
    //                 ],
    //             ],
    //             "WOOD_DOCS_LIST" => [],
    //             "ID" => 0,
    //             "TYPE" => "2",
    //             "CREATE_DATE" => "",
    //             "BUYER_TIN" => "12345678910",
    //             "CHEK_BUYER_TIN" => "0",
    //             "BUYER_NAME" => "სატესტო ტესტი",
    //             "START_ADDRESS" => "თბილისი, საბურთალოს ქუჩა",
    //             "END_ADDRESS" => "თბილისი, გულუას ქუჩა",
    //             "DRIVER_TIN" => "01005033495",
    //             "CHEK_DRIVER_TIN" => "1",
    //             "DRIVER_NAME" => "ლუკა ჩივიაშვილი",
    //             "TRANSPORT_COAST" => "30",
    //             "RECEPTION_INFO" => "wallah",
    //             "RECEIVER_INFO" => "guram",
    //             "DELIVERY_DATE" => "",
    //             "STATUS" => "1",
    //             "SELER_UN_ID" => "731937",
    //             "ACTIVATE_DATE" => "",
    //             "PAR_ID" => [],
    //             "FULL_AMOUNT" => "30",
    //             "FULL_AMOUNT_TXT" => "ოცდაათი ლარი და ნული თეთრი",
    //             "CAR_NUMBER" => "ww337nw",
    //             "WAYBILL_NUMBER" => "0935206807",
    //             "CLOSE_DATE" => [],
    //             "S_USER_ID" => "627031",
    //             "BEGIN_DATE" => "2025-10-24T22:46:35",
    //             "TRAN_COST_PAYER" => "1",
    //             "TRANS_ID" => "1",
    //             "TRANS_TXT" => "alo",
    //             "COMMENT" => "gamarjoba",
    //             "IS_CONFIRMED" => "0",
    //             "INVOICE_ID" => [],
    //             "CONFIRMATION_DATE" => [],
    //             "SELLER_TIN" => "206322102",
    //             "SELLER_NAME" => "სატესტო კოდი1",
    //             "WOOD_LABELS" => [],
    //             "CATEGORY" => [],
    //             "ORIGIN_TYPE" => [],
    //             "ORIGIN_TEXT" => [],
    //             "BUYER_S_USER_ID" => "0",
    //             "TOTAL_QUANTITY" => "10",
    //             "TRANSPORTER_TIN" => [],
    //             "CUST_STATUS" => "0",
    //             "CUST_NAME" => [],
    //             "CORRECTION_DATE" => "",
    //             "IS_MED" => "0",
    //         ]
    //     ];

    //     $waybill = $this->waybillService->createWaybill($waybillData);
    // }

    // function test_can_get_akciz_codes()
    // {
    // $resultArray = $this->waybillService->getExciseCodes($this->serviceUserDto);
    // $this->assertIsArray($resultArray, "Expected Array");
    // $this->assertNotEmpty($resultArray, "Result is empty");
    // }
    // 
    // function test_can_get_waybill_types()
    // {
    // $resultArray = $this->waybillService->getWaybillTypes($this->serviceUserDto);
    // $this->assertIsArray($resultArray, "Expected Array");
    // $this->assertNotEmpty($resultArray, "Result is empty");
    // }
    // 
    // function test_can_get_waybill_units()
    // {
    // $resultArray = $this->waybillService->getWaybillUnits($this->serviceUserDto);
    // $this->assertIsArray($resultArray, "Expected Array");
    // $this->assertNotEmpty($resultArray, "Result is empty");
    // }
    // 
    // function test_can_get_transportation_types()
    // {
    // $resultArray = $this->waybillService->getTransportationTypes($this->serviceUserDto);
    // $this->assertIsArray($resultArray, "Expected Array");
    // $this->assertNotEmpty($resultArray, "Result is empty");
    // }
    // 
    // function test_can_get_waybill_by_id()
    // {
    // $resultArray = $this->waybillService->getWaybillById($this->serviceUserDto, 975272683);
    // $this->assertIsArray($resultArray, "Expected Array");
    // $this->assertNotEmpty($resultArray, "Result is empty");
    // }
}
