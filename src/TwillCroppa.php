<?php

namespace C2H6\TwillCroppa;

use A17\Twill\Services\MediaLibrary\ImageServiceDefaults;
use A17\Twill\Services\MediaLibrary\ImageServiceInterface;
use Bkwld\Croppa\Facades\Croppa;

class TwillCroppa implements ImageServiceInterface
{
    use ImageServiceDefaults;

    public function getUrl($id, array $params = [])
    {
        return url(Croppa::url($this->url($id), $params["w"] ?? null, $params["h"] ?? null));
    }

    public function getUrlWithCrop($id, array $crop_params, array $params = [])
    {
        $trim_params = [
            "x1" => $crop_params["crop_x"],
            "y1" => $crop_params["crop_y"],
            "x2" => $crop_params["crop_x"] + $crop_params["crop_w"],
            "y2" => $crop_params["crop_y"] + $crop_params["crop_h"],
        ];

        return url(Croppa::url($this->url($id), $params["w"] ?? null, $params["h"] ?? null, ["trim" => $trim_params]));
    }

    public function getUrlWithFocalCrop($id, array $cropParams, $width, $height, array $params = [])
    {
        echo '">';
        dd("focal");
        dd($id, $params, $cropParams, $width, $height);
    }

    public function getLQIPUrl($id, array $params = [])
    {
        if (empty($params["w"]) && empty($params["h"])) $params["h"] = $params["w"] = 30;
        return url(Croppa::url($this->url($id), $params["w"] ?? null, $params["h"] ?? null, ["quality" => 25]));
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
            return [
                'width' => 0,
                'height' => 0,
            ];
        }
    }

    public function getRawUrl($id)
    {
        return Croppa::url($this->url($id));
    }

    private function url($id)
    {
        return "storage/uploads/$id";
    }
}
