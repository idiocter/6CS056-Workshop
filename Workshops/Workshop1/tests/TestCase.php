<?php

namespace Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function createApplication(): Application
    {
        $application = parent::createApplication();

        $application['config']->set('database.default', 'sqlite');
        $application['config']->set('database.connections.sqlite.database', ':memory:');

        return $application;
    }
}
