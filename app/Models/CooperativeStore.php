<?php

namespace App\Models;

use Hashids;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class CooperativeStore extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cooperative_stores';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
    ];

    /**
     * Get the cooperative store's link.
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        return sprintf(
            '%s-%s',
            urlencode($this->getAttribute('name')),
            Hashids::encode($this->getKey())
        );
    }

    /**
     * Register the conversions that should be performed.
     */
    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 300])
            ->performOnCollections('*')
            ->nonQueued();
    }
}
