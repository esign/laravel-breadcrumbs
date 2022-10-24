<?php

namespace Esign\Breadcrumbs\Facades;

use Illuminate\Support\Facades\Facade;

class BreadcrumbsFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'breadcrumbs';
    }
}
