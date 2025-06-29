<?php

namespace Fuelviews\SabHeroArticle\Filament\Resources\PostResource\Pages;

use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Fuelviews\SabHeroArticle\Events\ArticlePublished;
use Fuelviews\SabHeroArticle\Filament\Resources\PostResource;
use Illuminate\Contracts\Support\Htmlable;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sendNotification')
                ->label('Send Notification')
                ->requiresConfirmation()
                ->icon('heroicon-o-bell')
                ->action(function () {
                    event(new ArticlePublished($this->record));
                })
                ->disabled(fn () => $this->record->isNotPublished()),

            Action::make('preview')
                ->label('Preview')
                ->icon('heroicon-o-eye')
                ->url(fn () => route('sabhero-article.post.show', $this->record->slug), true)
                ->disabled(fn () => $this->record->isNotPublished()),
        ];
    }
}
