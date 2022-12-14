<?php

namespace Esign\Breadcrumbs\Tests\View\Components;

use Esign\Breadcrumbs\Facades\Breadcrumbs;
use Esign\Breadcrumbs\Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class BreadcrumbsComponentTest extends TestCase
{
    use InteractsWithViews;

    /** @test */
    public function it_wont_render_anything_if_breadcrumbs_are_empty()
    {
        $component = $this->blade('<x-breadcrumbs />');

        $this->assertEquals('', (string) $component);
    }

    /** @test */
    public function it_wont_render_urls_for_the_last_breadcrumb()
    {
        Breadcrumbs::add([
            'Home' => 'http://localhost',
            'Blog' => 'http://localhost/blog'
        ]);

        $component = $this->blade('<x-breadcrumbs />');

        $component->assertDontSee('http://localhost/blog');
    }

    /** @test */
    public function it_can_render_breadcrumbs_without_urls()
    {
        Breadcrumbs::add([
            'Home' => null,
            'Blog' => null,
        ]);

        $component = $this->blade('<x-breadcrumbs />');

        $component->assertDontSee('href');
        $component->assertSee('Home');
    }

    /** @test */
    public function it_can_render_breadcrumbs_with_urls()
    {
        Breadcrumbs::add([
            'Home' => 'http://localhost',
            'Blog' => null,
        ]);

        $component = $this->blade('<x-breadcrumbs />');

        $component->assertSee('href="http://localhost"', false);
        $component->assertSee('Home');
    }
}
