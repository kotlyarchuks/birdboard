<?php

namespace App;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];
    protected $touches = ['project'];
    protected $casts = [
        'completed' => 'boolean'
    ];

    protected static $recordableEvents = ['created', 'deleted'];

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
        $this->recordActivity('task_completed');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->recordActivity('task_incompleted');
    }
}
