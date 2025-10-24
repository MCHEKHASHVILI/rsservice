<?php

declare(strict_types=1);

namespace RS\Enums;

enum SoapEnvelopeNamespace: string
{
    case XSI = "http://www.w3.org/2001/XMLSchema-instance";
    case XSD = "http://www.w3.org/2001/XMLSchema";
    case SOAP = "http://schemas.xmlsoap.org/soap/envelope/";

    public static function toArray(): array
    {
        return array_reduce(
            self::cases(),
            function ($carry, $case) {
                $carry[strtolower($case->name)] = $case->value;
                return $carry;
            },
            []
        );
    }
}
