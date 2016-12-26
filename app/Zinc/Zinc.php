<?php

namespace App\Zinc;

use App\Core\Entity;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Zinc extends Entity implements HasMediaConversions
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['year', 'month', 'topic', 'published', 'published_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
    ];

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
