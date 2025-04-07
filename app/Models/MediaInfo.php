<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaInfo extends Media
{
    public function mediaable()
    {
        return $this->morphTo();
    }
}
