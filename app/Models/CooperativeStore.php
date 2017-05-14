<?php

namespace App\Models;

use Carbon\Carbon;
use Hashids;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class CooperativeStore extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cooperative_stores';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * Get the cooperative store's link.
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        return sprintf(
            '%s-%s',
            rawurlencode(rawurlencode($this->getAttribute('name'))),
            Hashids::encode($this->getKey())
        );
    }

    /**
     * 過濾已結束的特約商店.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('ended_at', '>=', Carbon::now()->toDateString());
    }

    /**
     * 過濾未發布的特約商店.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }
}
