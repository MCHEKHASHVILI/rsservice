<?php

declare(strict_types=1);

namespace RS\Requests\Waybill\BodyElements;

use Saloon\XmlWrangler\Data\Element;

class DefaultBodyElement extends Element
{
    protected function compose(): void
    {
        $this->setContent([
            "su" => "rsserviceuser:206322102",
            "sp" => "Password123!@#",
        ]);
    }
}
