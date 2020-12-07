<?php

namespace App;
use App\User;
use App\Job;
use Illuminate\Database\Eloquent\Model;

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
