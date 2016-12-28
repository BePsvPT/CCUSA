<?php

namespace App\Models;

class Contribution extends Model
{
    /**
     * The semesters that belong to the contribution.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function semesters()
    {
        return $this->belongsToMany(Semester::class);
    }
}
