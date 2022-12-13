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
        return $this->addOrPrepend($label, $url, false);
    }

    public function prepend(
        Breadcrumb | iterable | string | null $label,
        string | null $url = null,
    ): static {
        return $this->addOrPrepend($label, $url, true);
    }

    protected function addOrPrepend(
        Breadcrumb | iterable | string | null $label,
        string | null $url = null,
        bool $prepend = false,
    ): static {
        if (is_string($label) || is_null($label)) {
            $this->addOrPrepend(Breadcrumb::create($label, $url), null, $prepend);
        }

        if (is_iterable($label)) {
            $this->addOrPrependIterable($label, $prepend);
        }

        if ($label instanceof Breadcrumb) {
            $prepend
                ? $this->breadcrumbs->prepend($label)
                : $this->breadcrumbs->add($label);
        }

        return $this;
    }

    protected function addOrPrependIterable(iterable $breadcrumbs, bool $prepend): void
    {
        foreach ($breadcrumbs as $key => $value) {
            if ($value instanceof Breadcrumb) {
                $this->addOrPrepend($value, null, $prepend);
            }

            if (is_string($value) || is_null($value)) {
                $this->addOrPrepend(Breadcrumb::create($key, $value), null, $prepend);
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
