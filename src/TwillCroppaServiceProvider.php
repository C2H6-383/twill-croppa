<?php

namespace C2H6\TwillCroppa;

use A17\Twill\Models\Media;
use Bkwld\Croppa\Facades\Croppa;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class TwillCroppaServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        // Listen for Media deletion events and remove croppa crops of the file
        Event::listen('eloquent.deleting: ' . Media::class, function ($record) {
            // TODO MAKE PATHING VARIABLE (FROM CONFIG)
            Croppa::delete("storage/uploads/" . $record->uuid);
        });
    }
}
