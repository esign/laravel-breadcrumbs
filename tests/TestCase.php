<?php

namespace Esign\Breadcrumbs\Tests;

use Esign\Breadcrumbs\BreadcrumbsServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [BreadcrumbsServiceProvider::class];
    }
} 