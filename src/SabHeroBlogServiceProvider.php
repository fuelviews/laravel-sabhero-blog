<?php

namespace Fuelviews\SabHeroBlog;

use Fuelviews\SabHeroBlog\Commands\MakeFilamentUserCommand;
use Fuelviews\SabHeroBlog\Components\Breadcrumb;
use Fuelviews\SabHeroBlog\Components\Card;
use Fuelviews\SabHeroBlog\Components\FeatureCard;
use Fuelviews\SabHeroBlog\Components\HeaderCategory;
use Fuelviews\SabHeroBlog\Components\HeaderMetro;
use Fuelviews\SabHeroBlog\Components\Layout;
use Fuelviews\SabHeroBlog\Components\Markdown;
use Fuelviews\SabHeroBlog\Components\RecentPost;
use Fuelviews\SabHeroBlog\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SabHeroBlogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('sabhero-blog')
            ->hasConfigFile('sabhero-blog')
            ->hasMigrations([
                'create_blog_tables',
                'create_media_table',
                'create_imports_table',
                'create_exports_table',
                'create_failed_import_rows_table',
            ])
            ->hasViewComponents(
                'sabhero-blog',
                Layout::class,
                RecentPost::class,
                HeaderCategory::class,
                HeaderMetro::class,
                FeatureCard::class,
                Card::class,
                Markdown::class,
                Breadcrumb::class,
            )
            ->hasViews('sabhero-blog')
            ->hasRoutes([
                'web',
                'breadcrumbs',
            ])
            ->hasCommand(MakeFilamentUserCommand::class)
            ->hasInstallCommand(function (InstallCommand $installCommand) {
                $installCommand
                    ->startWith(function (InstallCommand $command) {
                        $command->info('Hello, and welcome to my great new package!');
                        $command->newLine(1);
                    })
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->endWith(function (InstallCommand $installCommand) {
                        $installCommand->newLine(1);
                        $installCommand->info('========================================================================================================');
                        $installCommand->info("Get ready to breathe easy! Our package has just saved you from a day's worth of headaches and hassle.");
                        $installCommand->info('========================================================================================================');

                    });
            });
        // $this->loadTestingMigration();
    }

    public function register()
    {
        Route::bind('post', function ($value) {
            return Post::where('slug', $value)
                ->published()
                ->with(['user', 'categories', 'tags', 'media', 'state', 'city'])
                ->firstOrFail();
        });

        View::composer([
            '*'
        ], function ($view) {
            if (request()->route() &&
                in_array(request()->route()->getName(), [
                    'sabhero-blog.post.show',
                    'sabhero-blog.post.metro.show',
                ])) {
                $seoPost = request()->route('post');

                $view->with([
                    'seoPost' => $seoPost,
                ]);
            }
        });

        $this->app->register(SabHeroBlogEventServiceProvider::class);

        return parent::register(); // TODO: Change the autogenerated stub
    }

    public function loadTestingMigration(): void
    {
        if ($this->app->environment('testing')) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }
}
