<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = [];
    protected $casts = ['changes' => 'array'];

    public function subject()
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
