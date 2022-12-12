<?php

namespace Esign\Breadcrumbs;

use Esign\Breadcrumbs\View\Components\BreadcrumbsComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom($this->viewPath(), 'breadcrumbs');
        Blade::component('breadcrumbs', BreadcrumbsComponent::class);
    }

    public function register()
    {
        $this->app->singleton('breadcrumbs', function () {
            return new Breadcrumbs();
        });
    }

    protected function viewPath(): string
    {
        return __DIR__ . '/../resources/views';
    }
}
