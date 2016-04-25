<?php

namespace App\Documents;

use App\Attachments\Attachment;
use App\Ccusa\Core\Entity;

class Document extends Entity
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group', 'published'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean'
    ];

    /**
     * 取得所有附件.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Document $document) {
            $document->load(['attachments']);

            $document->getRelation('attachments')->each(function (Attachment $attachment) {
                $attachment->delete();
            });
        });
    }
}
