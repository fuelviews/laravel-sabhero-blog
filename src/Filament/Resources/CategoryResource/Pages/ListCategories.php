<?php

namespace Fuelviews\SabHeroArticle\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Fuelviews\SabHeroArticle\Filament\Resources\CategoryResource;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
