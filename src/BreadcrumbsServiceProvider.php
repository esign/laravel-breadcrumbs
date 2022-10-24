<?php

namespace Esign\Breadcrumbs;

use Illuminate\Support\ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('breadcrumbs.php')], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'breadcrumbs');

        $this->app->singleton('breadcrumbs', function () {
            return new Breadcrumbs();
        });
    }

    protected function configPath(): string
    {
        return __DIR__ . '/../config/breadcrumbs.php';
    }
}
