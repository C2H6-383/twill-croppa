<?php

namespace C2H6\TwillCroppa\Traits;

/**
 * Detaches any Twill media model relations when force deleting the current model.
 */

trait DetachMediaOnForceDelete
{
    use DetachesMedia;

    public function forceDelete()
    {
        $this->detachMedia();

        return parent::forceDelete();
    }
}
