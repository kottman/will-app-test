<?php

namespace Tests;

class DatabaseTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('roles:create');
    }
}
