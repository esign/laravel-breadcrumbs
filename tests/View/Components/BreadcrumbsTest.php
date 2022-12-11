<?php

namespace Esign\Breadcrumbs\Tests\View\Components;

use Esign\Breadcrumbs\Facades\Breadcrumbs;
use Esign\Breadcrumbs\Tests\TestCase;
use Esign\Breadcrumbs\View\Components\Breadcrumbs as BreadcrumbsComponent;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class BreadcrumbsTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_wont_render_anything_if_breadcrumbs_are_empty()
    {
        $component = $this->component(BreadcrumbsComponent::class);

        $this->assertEquals('', (string) $component);
    }

    /** @test */
    public function it_can_render_breadcrumbs_without_urls()
    {
        Breadcrumbs::add('Home');

        $component = $this->component(BreadcrumbsComponent::class);

        $component->assertDontSee('href');
        $component->assertSee('Home');
    }

    /** @test */
    public function it_can_render_breadcrumbs_with_urls()
    {
        Breadcrumbs::add('Home', 'http://localhost');

        $component = $this->component(BreadcrumbsComponent::class);

        $component->assertSee('href="http://localhost"', false);
        $component->assertSee('Home');
    }
}
