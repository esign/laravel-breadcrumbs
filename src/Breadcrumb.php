<?php

namespace Esign\Breadcrumbs;

class Breadcrumb
{
    public function __construct(
        public ?string $label,
        public ?string $url = null,
        public ?string $image = null,
    ) {
    }

    public static function create(string $label, ?string $url = null, ?string $image = null): static
    {
        return new static($label, $url, $image);
    }
}
