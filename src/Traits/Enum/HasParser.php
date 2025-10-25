<?php

declare(strict_types=1);

namespace RS\Traits\Enum;

trait HasParser
{
    public function getActionName(): string
    {
        return explode('|', preg_replace('/\s+/', '', $this->value))[0] ?? '';
    }

    public function getResponsePath(): string
    {
        return explode('|', preg_replace('/\s+/', '', $this->value))[1] ?? '';
    }

    public function getResponsePathArray(): array
    {

        if (! (bool) $this->getResponsePath()) {
            return [];
        }
        return explode(".", $this->getResponsePath());
    }

    public function getErrorResponsePath(): string
    {
        return explode('|', preg_replace('/\s+/', '', $this->value))[2] ?? '';
    }

    public function getErrorResponsePathArray(): array
    {
        if (! (bool) $this->getErrorResponsePath()) {
            return [];
        }
        return explode(".", $this->getErrorResponsePath());
    }
}
