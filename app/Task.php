<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    protected $touches = ['project'];
    protected $casts = [
        'completed' => 'boolean'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return $this->project->path() . '/tasks/' . $this->id;
    }

    public function complete()
    {
        $this->update(['completed' => true]);
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function recordActivity($description): void
    {
        $this->activities()->create([
            'description' => $description,
            'project_id' => $this->project->id
        ]);
    }
}
