<?php

namespace App\Attachments;

use App\Core\Entity;
use File;

class Attachment extends Entity
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'file_name', 'mime_type', 'size'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $attachment) {
            File::delete($attachment->getPath());
        });
    }

    /**
     * Get the attachment path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getDirectory().'/'.$this->getAttribute('file_name');
    }

    /**
     * Get the directory to the attachment.
     *
     * @return mixed
     */
    public function getDirectory()
    {
        $prefixDir = intval(floor($this->getKey()/1000));

        return storage_path("app/attachments/{$prefixDir}");
    }
}
