<?php

namespace App\Ccusa\Vendor;

use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class MediaLibraryPathGenerator implements PathGenerator
{
    /**
     * Get the path for the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\Media $media
     *
     * @return string
     */
    public function getPath(Media $media)
    {
        return md5($media->getAttribute('model_id') . $media->getAttribute('model_type')) . '/';
    }

    /**
     * Get the path for conversions of the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\Media $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media)
    {
        return md5($media->getAttribute('model_id') . $media->getAttribute('model_type')). '/c/';
    }
}
