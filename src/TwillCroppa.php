<?php

namespace C2H6\TwillCroppa;

use A17\Twill\Services\MediaLibrary\ImageServiceDefaults;
use A17\Twill\Services\MediaLibrary\ImageServiceInterface;
use Bkwld\Croppa\Facades\Croppa;
use Illuminate\Support\Facades\Log;
use Nette\NotImplementedException;

/**
 * uses Croppa for rendering Twill media images.
 */
class TwillCroppa implements ImageServiceInterface
{
    use ImageServiceDefaults;

    public function getUrl($id, array $params = [])
    {
        $target_width = $params["w"] ?? null;
        $target_height = $params["h"] ?? null;

        return $this->croppaUrl($id, $target_width, $target_height);
    }

    public function getUrlWithCrop($id, array $crop_params, array $params = [])
    {
        // convert the Twill crop params into the Croppa format
        $trim_params = [
            "x1" => $crop_params["crop_x"],
            "y1" => $crop_params["crop_y"],
            "x2" => $crop_params["crop_x"] + $crop_params["crop_w"],
            "y2" => $crop_params["crop_y"] + $crop_params["crop_h"],
        ];

        $target_width = $params["w"] ?? null;
        $target_height = $params["h"] ?? null;

        $additional_params = ["trim" => $trim_params];

        return $this->croppaUrl($id, $target_width, $target_height, $additional_params);
    }

    public function getUrlWithFocalCrop($id, array $cropParams, $width, $height, array $params = [])
    {
        // todo: focal crop not implemented yet
        dump($id, $cropParams, $width, $height, $params);
        throw new NotImplementedException("This function is not implemented yet.");

        return $this->getUrlWithCrop($id, $cropParams, ["w" => $width, "h" => $height, ...$params]);
    }

    public function getLQIPUrl($id, array $params = [])
    {
        if ($this->sizeMissing($params))
            $params["h"] = $params["w"] = config("twillcroppa.lqip_dimension", 30);

        $target_width = $params["w"] ?? null;
        $target_height = $params["h"] ?? null;

        // set the quality really low
        $additional_params = ["quality" => config("twillcroppa.lqip_quality", 25)];

        return $this->croppaUrl($id, $target_width, $target_height, $additional_params);
    }

    public function getSocialUrl($id, array $params = [])
    {
        return $this->getUrl($id, $params);
    }

    public function getCmsUrl($id, array $params = [])
    {
        return $this->getLQIPUrl($id, $params);
    }

    public function getDimensions($id)
    {
        try {
            list($w, $h) = getimagesize(public_path($this->getUrl($id)));

            return [
                'width' => $w,
                'height' => $h,
            ];
        } catch (\Exception $exception) {
            Log::warning("TwillCroppa Media Service: Could not get media dimensions for media id $id.", ["id" => $id, "exception" => $exception]);

            return [
                'width' => 0,
                'height' => 0,
            ];
        }
    }

    public function getRawUrl($id)
    {
        return Croppa::url($this->path($id));
    }

    private function croppaUrl($id, int|null $target_width, int|null $target_height, array $additional_params = []): string
    {
        return url(Croppa::url($this->path($id), $target_width, $target_height, $additional_params));
    }

    /**
     * returns the path to the image for appending to the app base url.
     *
     * @param  mixed $id
     * @return string
     */
    private function path($id): string
    {
        $path = config("twillcroppa.media_files_path", "storage/uploads/");
        $path = sanitize_media_path($path);

        return $path . $id;
    }

    /**
     * checks if there ar any sizes set in the parameters array
     *
     * @param  array $params
     * @return bool
     */
    private function sizeMissing(array $params): bool
    {
        return empty($params["w"]) && empty($params["h"]);
    }
}
