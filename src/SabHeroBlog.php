<?php

namespace Fuelviews\SabHeroBlog;

use Filament\Contracts\Plugin;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\Support\Colors\Color;

class SabHeroBlog implements Plugin
{
    public static function make(): static
    {
        return new static();
    }

    public function getId(): string
    {
        return 'sabhero-blog';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            Filament\Resources\CategoryResource::class,
            Filament\Resources\PostResource::class,
            Filament\Resources\TagResource::class,
            Filament\Resources\MetroResource::class,
            Filament\Resources\PageResource::class,
            Filament\Resources\UserResource::class,
        ]);

        $panel->colors([
            'cyan' => Color::Cyan,
        ]);

        $panel->navigationItems([
            NavigationItem::make('CRM')
                ->label(config('sabhero-blog.crm.name'))
                ->url(config('sabhero-blog.crm.link'), shouldOpenInNewTab: true)
                ->icon('heroicon-o-presentation-chart-line')
                ->sort(1),
        ]);
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
