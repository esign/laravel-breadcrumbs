<?php

namespace Esign\Breadcrumbs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection get()
 * @method static self add(\Esign\Breadcrumbs\Breadcrumb | iterable | string | null $label, string | null $url = null)
 * @method static self prepend(\Esign\Breadcrumbs\Breadcrumb | iterable | string | null $label, string | null $url = null)
 * @method static \Spatie\SchemaOrg\BreadcrumbList toJsonLd()
 *
 * @see \Esign\Breadcrumbs\Breadcrumbs
 */
class Breadcrumbs extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'breadcrumbs';
    }
}
