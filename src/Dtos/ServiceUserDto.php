<?php

declare(strict_types=1);

namespace Mchekhashvili\Rsservice\Dtos;

class ServiceUserDto
{
    /**
     * @property string $su service user
     * @property string $sp service password
     */
    public function __construct(
        public readonly string $su,
        public readonly string $sp
    ) {}

    public function toArray(): array
    {
        return (array) $this;
    }
}
