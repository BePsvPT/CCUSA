<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Zinc extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zinc';

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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * Get the zinc's identify.
     *
     * @return array
     */
    public function getIdentifyAttribute()
    {
        return array_only($this->getAttributes(), ['year', 'month']);
    }

    /**
     * Register the conversions that should be performed.
     */
    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->performOnCollections('*')
            ->nonQueued();
    }

    /**
     * 取得年份，用於新增和編輯會刊.
     *
     * @return array
     */
    public static function year()
    {
        $now = Carbon::now()->subYear()->year;

        $years = range($now, $now + 5);

        return array_combine($years, $years);
    }

    /**
     * 取得月份，用於新增和編輯會刊.
     *
     * @return array
     */
    public static function month()
    {
        for ($i = 1; $i <= 12; ++$i) {
            $c = sprintf('%02u', $i);

            $ranges[$c] = $c;
        }

        return $ranges;
    }
}
