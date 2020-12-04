<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'title',
        'description',
        'experience',
        'salary',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'application');
    }

    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggable')->withPivot('type');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
