# SabHero Blog Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fuelviews/laravel-sabhero-blog.svg?style=flat-square)](https://packagist.org/packages/fuelviews/laravel-sabhero-blog)
[![Total Downloads](https://img.shields.io/packagist/dt/fuelviews/laravel-sabhero-blog.svg?style=flat-square)](https://packagist.org/packages/fuelviews/laravel-sabhero-blog)

A full-featured blog management solution for Laravel applications with Filament admin panel integration. This package provides a complete blogging platform with advanced features and an intuitive admin interface.

## Features

- **Complete Blog Management**: Posts, categories, tags, and authors
- **Scheduled Publishing**: Schedule posts to be published automatically
- **Blade Components**: Ready-to-use UI components including cards, feature cards, and breadcrumbs
- **Advanced Content**: Markdown rendering with automatic table of contents
- **Media Management**: Image uploads with responsive images support
- **SEO Optimization**: Built-in SEO meta data for better search rankings
- **RSS Feed**: Automatic feed generation with customizable settings
- **Tailwind Pagination**: Custom pagination views for Tailwind CSS
- **Filament Integration**: Full admin panel for managing all blog content

## Installation

### Prerequisites

This package requires Filament. If your project doesn't have Filament yet:

```bash
composer require filament/filament:"^3.2" -W
php artisan filament:install --panels
```

### Create a Filament User
```bash
php artisan make:filament-user
```

### Install the SabHero Blog Package

```bash
composer require fuelviews/laravel-sabhero-blog
```

## Configuration

### 1. Publish Configuration Files

```bash
php artisan vendor:publish --tag="sabhero-blog-config"
```

### 2. Publish Migrations

```bash
php artisan vendor:publish --tag="sabhero-blog-migrations"
```

### 3. Run Migrations

```bash
php artisan migrate
```

## Integration

### 1. Attach to Filament Panel

Add the SabHero Blog plugin to your Filament panel provider:

```php
use Fuelviews\SabHeroBlog\Facades\SabHeroBlog;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            SabHeroBlog::make()
        ]);
}
```

### 2. Add Traits and CanAccessPanel to User Model

Your user model needs to bet setup to use `HasBlog` and `HasAuthor` traits, don't forget setting `CanAccessPanel`:

```php
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Fuelviews\SabHeroBlog\Traits\HasAuthor;
use Fuelviews\SabHeroBlog\Traits\HasBlog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable, HasBlog, HasAuthor;
    
    public function canAccessPanel(Panel $panel): bool
    {
        $allowedDomains = ['@fuelviews.com', 'admin.com'];

        foreach ($allowedDomains as $domain) {
            if (str_ends_with($this->email, $domain)) {
                return true;
            }
        }

        return false;
    }
}
```

## RSS Feed

The package automatically generates an RSS feed available at `/blog/rss`. To customize feed settings:

```bash
php artisan vendor:publish --tag="sabhero-blog-feed-config"
```

## Available Components

SabHero Blog comes with several Blade components for easy UI implementation:

- `<x-sabhero-blog::layout>` - Main blog layout
- `<x-sabhero-blog::card>` - Blog post card
- `<x-sabhero-blog::feature-card>` - Featured post card
- `<x-sabhero-blog::breadcrumb>` - Breadcrumb navigation
- `<x-sabhero-blog::header-category>` - Category header
- `<x-sabhero-blog::header-metro>` - Metro-style header
- `<x-sabhero-blog::markdown>` - Markdown content renderer
- `<x-sabhero-blog::recent-post>` - Recent posts display

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on recent changes.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for contribution guidelines.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Joshua Mitchener](https://github.com/thejmitchener)
- [Daniel Clark](https://github.com/sweatybreeze)
- [Fuelviews](https://github.com/fuelviews)
- [Firefly](https://github.com/thefireflytech)
- [Asmit Nepali](https://github.com/AsmitNepali)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
