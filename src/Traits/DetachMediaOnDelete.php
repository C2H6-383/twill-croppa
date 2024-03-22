<?php

namespace C2H6\TwillCroppa\Traits;

trait DetachMediaOnDelete
{
    public function delete()
    {
        $this->medias()->detach();

        return parent::delete();
    }
}
