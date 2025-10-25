<?php

declare(strict_types=1);

namespace RS\Enums;

use RS\XmlElements\MainUserCredentialsElement;
use RS\XmlElements\ServiceUserCredentialsElement;

enum SoapUserCredentials: string
{
    case MAIN_USER = MainUserCredentialsElement::class;
    case SERVICE_USER = ServiceUserCredentialsElement::class;
}
