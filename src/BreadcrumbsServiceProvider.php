<?php

namespace Esign\Breadcrumbs;

use Esign\Breadcrumbs\View\Components\Breadcrumbs as BreadcrumbsComponent;
use Illuminate\Support\ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom($this->viewPath(), 'breadcrumbs');
        $this->loadViewComponentsAs('breadcrumbs', [
            'breadcrumbs' => BreadcrumbsComponent::class,
        ]);

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

    protected function viewPath(): string
    {
        return __DIR__ . '/../resources/views';
    }
}
