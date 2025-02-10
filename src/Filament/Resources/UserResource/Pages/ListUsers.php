<?php

namespace Fuelviews\SabHeroBlog\Filament\Resources\UserResource\Pages;

use Fuelviews\SabHeroBlog\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
