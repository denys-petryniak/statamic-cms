<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Statamic\Statamic;
use Statamic\Assets\Asset;
use App\Http\Resources\CustomAsset;
use Statamic\Entries\Entry;
use App\Http\Resources\CustomEntry;
use Statamic\Http\Resources\API\Resource;
use Statamic\Http\Resources\API\EntryResource;
use App\Http\Resources\CustomEntryResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(\Statamic\Contracts\Entries\Entry::class, \App\Http\Resources\CustomEntry::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Statamic::vite('app', [
        //     'resources/js/cp.js',
        //     'resources/css/cp.css',
        // ]);

        {
            Resource::map([
                EntryResource::class => CustomEntryResource::class,
            ]);
        }

        $this->app->bind(
            Asset::class,
            CustomAsset::class
        );

        $this->app->bind(
            Entry::class,
            CustomEntry::class
        );
    }
}
