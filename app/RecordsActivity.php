<?php

namespace App;


trait RecordsActivity   
{
    protected static function bootRecordsActivity() {
        if(auth()->guest()) return;

        foreach (static::getActivityToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model) {
            $model->activity()->delete();
        });
    }

    protected static function getActivityToRecord() {
        return ['created'];
    }
    
    protected function recordActivity($event) {
        $this->activity()->create([
            'user_id'=> auth()->id(),
            'type'=> $this->getActivityEvent($event),
        ]);
    }

    protected function activity() {
        return $this->morphMany('App\Activity', 'subject');
    }

    protected function getActivityEvent($event) {
        return $event.'_'.strtolower((new \ReflectionClass($this))->getShortName());
    }
}