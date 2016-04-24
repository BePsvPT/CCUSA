<?php

namespace App\Ccusa;

use App\Ccusa\Core\Entity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Zinc extends Entity implements HasMedia
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
        'published' => 'boolean'
    ];

    /**
     * 取得年份，用於新增和編輯會刊
     *
     * @return array
     */
    public static function year()
    {
        $year = 2015;
        $years = [];

        while ($year <= 2020) {
            $years[$year] = $year;

            $year++;
        }

        return $years;
    }

    /**
     * 取得月份，用於新增和編輯會刊
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
