<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * Get the semester that owns the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    /**
     * The contributions that belong to the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contributions()
    {
        return $this->belongsToMany(Contribution::class)
            ->withTimestamps()
            ->withPivot(['phone', 'email', 'triggered_at']);
    }
}
