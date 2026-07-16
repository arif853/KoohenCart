<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    // CreatesApplication also refuses to boot against a non-test database, so a
    // wrong DB_DATABASE can never reach RefreshDatabase's migrate:fresh.
    use CreatesApplication;

    /**
     * Seed the test database on the single migrate:fresh that RefreshDatabase runs
     * per test run. It lives on the base class because whichever test class happens
     * to run first triggers that migration, and tests that read seeded data (a
     * product to buy, postcodes) must not depend on that ordering.
     */
    protected $seed = true;
}
