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
    public function register(): void
    {
        $this->mergeConfigs();
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishConfig();

        $this->registerEventListeners();
    }
    
    /**
     * merges all used configs
     *
     * @return void
     */
    private function mergeConfigs(): void
    {
        // merge croppa default config values
        $this->mergeConfigFrom(
            __DIR__ . '/../config/croppa.php',
            'croppa'
        );

        // merge twill-croppa config values
        $this->mergeConfigFrom(
            __DIR__ . '/../config/twillcroppa.php',
            'twillcroppa'
        );
    }

    private function publishConfig(): void
    {
        // publishes the config files
        $this->publishes([
            __DIR__ . '/../config/twillcroppa.php' => config_path('twillcroppa.php'),
        ], "twillcroppa-config");
    }
    
    /**
     * registers the media deletion event listerners if needed
     *
     * @return void
     */
    private function registerEventListeners(): void
    {
        // if this plugin is not used as rendering service, do not listen for any events
        if (config("twill.media_library.image_service", null) != TwillCroppa::class) return;

        // prepare the media path for the following event listener
        $path = config("twillcroppa.media_files_path", "storage/uploads/");
        $path = sanitize_media_path($path);

        // Listen for Media deletion events and remove croppa crops of the file
        Event::listen('eloquent.deleting: ' . Media::class, function ($record) use ($path) {
            Croppa::delete($path . $record->uuid);
        });
    }
}
