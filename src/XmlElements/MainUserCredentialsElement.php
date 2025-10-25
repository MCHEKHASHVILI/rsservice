<?php

declare(strict_types=1);

namespace RS\XmlElements;

use Saloon\XmlWrangler\Data\Element;

class MainUserCredentialsElement extends Element
{
    protected function compose(): void
    {
        $this->setContent([
            "user_name" => "tbilisi",
            "user_password" => "123456",
        ]);
    }
}
