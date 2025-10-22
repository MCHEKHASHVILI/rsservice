<?php

declare(strict_types=1);

namespace Mchekhashvili\Rsservice\Dtos;

class MainUserDto
{
    /**
     * @property string $user_name main user
     * @property string $user_password main password
     */
    public function __construct(
        public readonly string $user_name,
        public readonly string $user_password
    ) {}

    public function toArray(): array
    {
        return (array) $this;
    }
}
