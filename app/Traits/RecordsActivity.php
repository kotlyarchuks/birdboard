<?php


namespace App\Traits;


use App\Activity;
use Illuminate\Support\Arr;

trait RecordsActivity {
    public $oldAttributes = [];

    public static function bootRecordsActivity(){
        foreach (self::recordableEvents() as $event){
            static::$event(function($model) use ($event){
                $model->recordActivity($model->getDescription($event));
            });

            if($event === 'updated'){
                static::updating(function($model){
                    $model->oldAttributes = $model->getOriginal();
                });
            }
        }
    }

    public static function recordableEvents()
    {
        if (isset(static::$recordableEvents))
        {
            return static::$recordableEvents;
        }
        return ['created', 'updated', 'deleted'];
    }

    public function recordActivity($description): void
    {
        $this->activities()->create([
            'description' => $description,
            'changes' => $this->getModelChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project->id,
            'author_id' => ($this->project ?? $this)->owner->id
        ]);
    }

    protected function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function getModelChanges()
    {
        if ($this->wasChanged()){
            return [
                'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after' => Arr::except($this->getChanges(), 'updated_at')
            ];
        }
    }

    protected function getDescription($event)
    {
        return strtolower(class_basename($this))."_".$event;
    }
}