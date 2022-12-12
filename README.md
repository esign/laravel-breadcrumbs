# Manage breadcrumbs within your Laravel application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/esign/laravel-breadcrumbs.svg?style=flat-square)](https://packagist.org/packages/esign/laravel-breadcrumbs)
[![Total Downloads](https://img.shields.io/packagist/dt/esign/laravel-breadcrumbs.svg?style=flat-square)](https://packagist.org/packages/esign/laravel-breadcrumbs)
![GitHub Actions](https://github.com/esign/laravel-breadcrumbs/actions/workflows/main.yml/badge.svg)

This package allows you to manage and render breadcrumbs within your Laravel application.

## Installation

You can install the package via composer:

```bash
composer require esign/laravel-breadcrumbs
```

The package will automatically register a service provider.

## Usage
You may start adding breadcrumbs by using the `Breadcrumbs` facade.
This is typically done from the controller.

```php
use Esign\Breadcrumbs\Breadcrumb;
use Esign\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::add('Home');
Breadcrumbs::add(Breadcrumb::create('Home'));
```

Or add multiple breadcrumbs at once:
```php
use Esign\Breadcrumbs\Breadcrumb;
use Esign\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::add([
    'Home' => 'https://www.example.com',
    'Blog' => null,
]);
Breadcrumbs::add([
    Breadcrumb::create('Home', 'https://www.example.com'),
    Breadcrumb::create('Blog'),
]);
```

### Converting to JsonLd
To convert your breadcrumbs to [JSON-LD](https://json-ld.org/) you may use the `toJsonLd` method.
This method will return an instance of `Spatie\SchemaOrg\BreadcrumbList`.
```php
use Esign\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::toJsonLd();
```

You may cast this instance to a string to render the actual script tag:
```php
(string) Breadcrumbs::toJsonLd(); // <script type="application/ld+json">...</script>
```

### Rendering breadcrumbs
This package ships with a view component to render your breadcrumbs trail:
```blade
<x-breadcrumbs />
```

This will render the following HTML:
```php
use Esign\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::add([
    'Home' => 'https://www.example.com',
    'Blog' => null,
]);
```
```html
<ol class="breadcrumbs">
  <li class="breadcrumbs__item">
    <a href="https://www.example.com" class="breadcrumbs__link">Home</a>
  </li>
  <li class="breadcrumbs__item">Blog</li>
</ol>
```

### Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
