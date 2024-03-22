<?php

namespace C2H6\TwillCroppa\Traits;

/**
 * Detaches any Twill media model relations when deleting the current model.
 */

trait DetachMediaOnDelete
{
    use DetachesMedia;

    public function delete()
    {
        $this->detachMedia();

        return parent::delete();
    }
}
