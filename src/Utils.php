<?php

namespace C2H6\TwillCroppa;

use Illuminate\Support\Str;

if (!function_exists("sanitize_media_path")) {

    // removes or adds slashes to format the path according to needs
    function sanitize_media_path(string $path): string
    {
        // remove any prepending slashes
        if (Str::startsWith($path, "/"))
            $path = Str::substr($path, 1);

        // force an ending slash
        if (!Str::endsWith($path, "/"))
            $path .= "/";

        return $path;
    }
}
