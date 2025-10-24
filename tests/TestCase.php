<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Base test case for Pest tests.
 *
 * Declaring @property annotations here silences IDE / static-analysis warnings
 * when Pest assigns dynamic properties like $this->connector and $this->request
 * in beforeEach closures. We also allow dynamic properties at runtime to avoid
 * PHP 8.2 deprecation notices.
 *
 * @property mixed $connector
 * @property mixed $request
 * @property mixed $response
 */
#[\AllowDynamicProperties]
abstract class TestCase extends BaseTestCase
{
    // intentionally empty: Pest sets test-scope properties dynamically in beforeEach
}
