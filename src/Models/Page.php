<?php

namespace Fuelviews\SabHeroArticle\Models;

use Database\Factories\PageFactory;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements HasMedia
{
    use HasFactory;
    use HasSEO;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'description',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    protected static function newFactory(): PageFactory
    {
        return new PageFactory;
    }

    public function getSeoDataAttribute(): SEOData
    {
        return new SEOData(
            title: ucfirst($this->title ?? ''),
            description: ucfirst($this->description ?? ''),
            image: $this->getFirstMediaUrl('page_feature_image'),
        );
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('feature_image')
            ->withResponsiveImages()
            ->performOnCollections('page_feature_image');
    }

    public static function getForm(): array
    {
        return [
            Section::make('SEO Metadata')
                ->columns(2)
                ->schema([
                    TextInput::make('title')
                        ->required(),

                    TextInput::make('slug')
                        ->required()
                        ->unique(Page::class, ignoreRecord: true)
                        ->formatStateUsing(fn ($state) => Str::slug($state)),

                    Textarea::make('description')
                        ->label('Meta Description')
                        ->required()
                        ->columnSpanFull(),

                    SpatieMediaLibraryFileUpload::make('feature_image')
                        ->label('Feature Image')
                        ->collection('page_feature_image')
                        ->image()
                        ->responsiveImages()
                        ->required()
                        ->columnSpanFull(),
                ]),
        ];
    }
}
