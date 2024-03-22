<?php

namespace C2H6\TwillCroppa\Traits;

/**
 * Detaches any twill media relations to the current model.
 */
trait DetachesMedia
{
    public function detachMedia(): void
    {
        $this->medias()->detach();
    }
}
