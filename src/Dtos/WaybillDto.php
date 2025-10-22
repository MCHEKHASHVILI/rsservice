<?php

declare(strict_types=1);

namespace Mchekhashvili\Rsservice\Dtos;

class WaybillDto
{
    public function __construct(
        public readonly int $waybill_number,
        public readonly int $buyer_license_number,
        public readonly string $buyer_name,
        public readonly int $seller_license_number,
        public readonly string $seller_name,
    ) {}
}
