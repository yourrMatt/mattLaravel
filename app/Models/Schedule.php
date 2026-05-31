<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'class_schedules';
    public $timestamps = false;

    protected $fillable = [
        'name'
        , 'class_subject'
        , 'class_professor'
        , 'class_location'
        , 'day'
        , 'time_start'
        , 'time_end'
    ];
}
