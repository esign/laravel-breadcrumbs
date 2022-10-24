<?php

namespace Esign\Breadcrumbs;

use Illuminate\Support\Collection;
use Spatie\SchemaOrg\BreadcrumbList;
use Spatie\SchemaOrg\Schema;

class Breadcrumbs
{
    protected Collection $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = new Collection();
    }

    public function get(): Collection
    {
        return $this->breadcrumbs;
    }

    public function add(
        Breadcrumb | iterable | string | null $label,
        string | null $url = null,
    ): static {
        if (is_string($label) || is_null($label)) {
            $this->add(Breadcrumb::create($label, $url));
        }

        if (is_iterable($label)) {
            $this->addIterable($label);
        }

        if ($label instanceof Breadcrumb) {
            $this->breadcrumbs->push($label);
        }

        return $this;
    }

    protected function addIterable(iterable $breadcrumbs): void
    {
        foreach ($breadcrumbs as $key => $value) {
            if ($value instanceof Breadcrumb) {
                $this->add($value);
            }

            if (is_string($value) || is_null($value)) {
                $this->add(Breadcrumb::create($key, $value));
            }
        }
    }

    public function toJsonLd(): BreadcrumbList
    {
        $itemListElements = $this->breadcrumbs->map(function (Breadcrumb $breadcrumb, int $index) {
            return Schema::listItem()
                ->position($index + 1)
                ->name($breadcrumb->label)
                ->item($breadcrumb->url);
        });

        return Schema::breadcrumbList()->itemListElement($itemListElements->toArray());
    }
}
