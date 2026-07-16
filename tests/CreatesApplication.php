<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use RuntimeException;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $this->guardAgainstNonTestDatabase($app);

        return $app;
    }

    /**
     * Refuse to run against anything but a dedicated test database.
     *
     * Tests here use RefreshDatabase (migrate:fresh) against a real MySQL server
     * rather than in-memory SQLite, so a wrong DB_DATABASE destroys real data
     * instead of failing. phpunit.xml points at koohen_testing; this makes a
     * mistake loud instead of destructive.
     *
     * This lives in createApplication() on purpose: TestCase::setUp() boots the
     * application and only then runs setUpTraits(), which is what fires
     * RefreshDatabase's migrate:fresh. A check placed after parent::setUp() would
     * therefore run after the database had already been dropped.
     */
    private function guardAgainstNonTestDatabase(Application $app): void
    {
        $connection = $app['config']->get('database.default');
        $database = (string) $app['config']->get("database.connections.{$connection}.database");

        if (str_contains($database, 'testing') || in_array($database, [':memory:', ''], true)) {
            return;
        }

        throw new RuntimeException(
            "Refusing to run tests against the '{$database}' database: it is not a test database. "
            . 'Tests run migrate:fresh and would destroy its contents. Set DB_DATABASE to koohen_testing '
            . 'in phpunit.xml (create it once with: CREATE DATABASE koohen_testing).'
        );
    }
}
