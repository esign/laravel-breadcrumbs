<?php

namespace Esign\Breadcrumbs\Tests\View\Components;

use PHPUnit\Framework\Attributes\Test;
use Esign\Breadcrumbs\Facades\Breadcrumbs;
use Esign\Breadcrumbs\Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

final class BreadcrumbsComponentTest extends TestCase
{
    use InteractsWithViews;

    #[Test]
    public function it_wont_render_anything_if_breadcrumbs_are_empty(): void
    {
        $component = $this->blade('<x-breadcrumbs />');

        $this->assertEquals('', (string) $component);
    }

    #[Test]
    public function it_wont_render_urls_for_the_last_breadcrumb(): void
    {
        Breadcrumbs::add([
            'Home' => 'http://localhost',
            'Blog' => 'http://localhost/blog'
        ]);

        $component = $this->blade('<x-breadcrumbs />');

        $component->assertDontSee('http://localhost/blog');
    }

    #[Test]
    public function it_can_render_breadcrumbs_without_urls(): void
    {
        Breadcrumbs::add([
            'Home' => null,
            'Blog' => null,
        ]);

        $component = $this->blade('<x-breadcrumbs />');

        $component->assertDontSee('href');
        $component->assertSee('Home');
    }

    #[Test]
    public function it_can_render_breadcrumbs_with_urls(): void
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
