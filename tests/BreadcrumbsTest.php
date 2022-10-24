<?php

namespace Esign\Breadcrumbs\Tests;

use Esign\Breadcrumbs\Breadcrumb;
use Esign\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Collection;
use Spatie\SchemaOrg\BreadcrumbList;
use Spatie\SchemaOrg\ListItem;

class BreadcrumbsTest extends TestCase
{
    /** @test */
    public function it_can_get_the_breadcrumbs()
    {
        $this->assertInstanceOf(Collection::class, $breadcrumbs = Breadcrumbs::get());
        $this->assertCount(0, $breadcrumbs);
    }

    /** @test */
    public function it_can_add_a_single_breadcrumb()
    {
        Breadcrumbs::add(Breadcrumb::create('Home', 'http://localhost'));

        $this->assertInstanceOf(Collection::class, $breadcrumbs = Breadcrumbs::get());
        $this->assertInstanceOf(Breadcrumb::class, $breadcrumb = $breadcrumbs->first());
        $this->assertCount(1, $breadcrumbs);
        $this->assertEquals('Home', $breadcrumb->label);
        $this->assertEquals('http://localhost', $breadcrumb->url);
    }

    /** @test */
    public function it_can_add_multiple_breadcrumbs()
    {
        Breadcrumbs::add([
            Breadcrumb::create('Home', 'http://localhost'),
            Breadcrumb::create('Blog', 'http://localhost/blog'),
        ]);

        $this->assertInstanceOf(Collection::class, $breadcrumbs = Breadcrumbs::get());
        $this->assertCount(2, $breadcrumbs);
    }

    /** @test */
    public function it_can_add_multiple_using_label_and_url_as_key_and_value()
    {
        Breadcrumbs::add(['Home' => 'http://localhost']);

        $this->assertInstanceOf(Collection::class, $breadcrumbs = Breadcrumbs::get());
        $this->assertInstanceOf(Breadcrumb::class, $breadcrumb = $breadcrumbs->first());
        $this->assertCount(1, $breadcrumbs);
        $this->assertEquals('Home', $breadcrumb->label);
        $this->assertEquals('http://localhost', $breadcrumb->url);
    }

    /** @test */
    public function it_can_add_using_label_and_url_as_parameters()
    {
        Breadcrumbs::add('Home', 'http://localhost');

        $this->assertInstanceOf(Collection::class, $breadcrumbs = Breadcrumbs::get());
        $this->assertInstanceOf(Breadcrumb::class, $breadcrumb = $breadcrumbs->first());
        $this->assertCount(1, $breadcrumbs);
        $this->assertEquals('Home', $breadcrumb->label);
        $this->assertEquals('http://localhost', $breadcrumb->url);
    }

    /** @test */
    public function it_can_add_a_label_as_a_string_without_providing_a_url()
    {
        Breadcrumbs::add('Home');

        $this->assertInstanceOf(Collection::class, $breadcrumbs = Breadcrumbs::get());
        $this->assertInstanceOf(Breadcrumb::class, $breadcrumb = $breadcrumbs->first());
        $this->assertCount(1, $breadcrumbs);
        $this->assertEquals('Home', $breadcrumb->label);
        $this->assertEquals(null, $breadcrumb->url);
    }

    /** @test */
    public function it_can_cast_to_json_ld()
    {
        Breadcrumbs::add(Breadcrumb::create('Home', 'http://localhost'));

        $this->assertInstanceOf(BreadcrumbList::class, $jsonLd = Breadcrumbs::toJsonLd());
        $this->assertIsArray($itemListElements = $jsonLd->getProperty('itemListElement'));
        $this->assertInstanceOf(ListItem::class, $itemListElement = $itemListElements[0]);
        $this->assertEquals('Home', $itemListElement->getProperty('name'));
        $this->assertEquals('http://localhost', $itemListElement->getProperty('item'));
        $this->assertEquals(1, $itemListElement->getProperty('position'));
    }
}
