<?php

declare(strict_types=1);

namespace RS\XmlElements;

use Saloon\XmlWrangler\Data\Element;

class ServiceUserCredentialsElement extends Element
{
    protected function compose(): void
    {
        $this->setContent([
            "su" => "rsserviceuser:206322102",
            "sp" => "Password123!@#",
        ]);
    }
}
