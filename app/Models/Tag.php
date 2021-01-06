<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use App\Models\User;

class Tag extends Model
{
    public function taggable()
    {
        return $this->morphTo();
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'taggable');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function jobs()
    {
        return $this->morphedByMany(Job::class, 'taggable');
    }
}
