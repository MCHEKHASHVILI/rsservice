<?php

declare(strict_types=1);

namespace RS\Interfaces\Enum;

/**
 * Parsing specified string in actions enum
 * String reserves two special characters "|" and "."
 * "|" separates 3 steps:
 * 1) Action Method;
 * 2) XPath to desired resource
 * 3) XPath to error status
 * 
 * By spliting XPath with "." we get a key chain to desired response in for response->parsed() method 
 */
interface HasParserInterface
{
    public function getActionName(): string;

    public function getResponsePath(): string;

    public function getResponsePathArray(): array;

    public function getErrorResponsePath(): string;

    public function getErrorResponsePathArray(): array;
}
