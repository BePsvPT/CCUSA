<?php

namespace App\Documents;

use App\Attachments\Attachment;
use App\Core\Entity;
use Auth;

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
     * Get the attachments of the document.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    /**
     * Scope a query to only include published documents.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGuest($query)
    {
        $user = Auth::user();

        if (is_null($user) || ! $user->hasRole('documents')) {
            return $query->where('published', true);
        }

        return $query;
    }

    /**
     * Transform published value to bool.
     *
     * @param mixed $value
     *
     * @return $this
     */
    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = boolval($value);
        
        return $this;
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $document) {
            $document->load(['attachments'])
                ->getRelation('attachments')
                ->each(function (Attachment $attachment) {
                    $attachment->delete();
                });
        });
    }
}
