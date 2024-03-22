<?php

namespace C2H6\TwillCroppa\Traits;

trait DetachMediaOnForceDelete
{
    public function forceDelete()
    {
        $this->medias()->detach();

        return parent::forceDelete();
    }
}
