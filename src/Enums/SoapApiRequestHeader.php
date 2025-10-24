<?php

declare(strict_types=1);

namespace RS\Enums;

enum SoapApiRequestHeader: string
{
    case CONTENT_TYPE = "text/xml; charset=utf-8";
    case ACTION_URL = "http://tempuri.org/";
}
