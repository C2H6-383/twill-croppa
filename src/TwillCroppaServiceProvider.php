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
        $this->mergeConfigFrom(
            __DIR__ . '/../config/croppa.php',
            'croppa'
        );

        $this->mergeConfigFrom(
            __DIR__ . '/../config/twillcroppa.php',
            'twillcroppa'
        );
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        // prepare the media path for the following event listener
        $path = config("twillcroppa.media_files_path", "storage/uploads/");
        $path = sanitize_media_path($path);

        // Listen for Media deletion events and remove croppa crops of the file
        Event::listen('eloquent.deleting: ' . Media::class, function ($record) use ($path) {
            Croppa::delete($path . $record->uuid);
        });


        // publishes the config files
        $this->publishes([
            __DIR__ . '/../config/twillcroppa.php' => config_path('twillcroppa.php'),
        ],"twillcroppa-config");
    }
}
