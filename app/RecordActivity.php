<?php

namespace App;

trait RecordActivity
{
    public static function bootRecordActivity()
    {
        foreach(self::recordableEvents() as $event) {
            static::$event(function($model) use ($event) {
                $model->recordActivity(class_basename($model), $event);
            });
        }
    }

    public function recordActivity($model, $event)
    {   
        switch($model){
            case 'User':
            case 'Testimonial':
            case 'Team':
                $subject_name = $this->name;
                break;
            case 'Project':
            case 'Service':
            case 'Blog':
            $subject_name = $this->title;
            break;
            case 'Mail':
                $subject_name = $this->subject;
                break;
            case 'Newsletter':
                $subject_name = $this->email;
                break;
        }
        Activity::create([
            'user_id' => auth()->id(),
            'description' => $event,
            'subject_type' => "App\\{$model}",
            'subject_id' => $this->id,
            'subject_name' => $subject_name
        ]);
    }

    protected static function recordableEvents()
    {                   
        if (isset(self::$recordableEvents)){
            return static::$recordableEvents;
        } else {
            return ['created', 'updated', 'deleted'];
        }
    }
}