<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function showCalendar(){
        $classSchedule = Schedule::all()->map(function ($c){
            return (object)[
                'sched_id' => $c->sched_id,
                'day'     => $c->day,
                'class_subject' => $c->class_subject,
                'time'    => \Carbon\Carbon::parse($c->time_start)->format('g:i A') 
                           . ' – ' . 
                           \Carbon\Carbon::parse($c->time_end)->format('g:i A'),
                'time_start'    => $c->time_start,
                'time_end'    => $c->time_end,
                'class_location'    => $c->class_location,
                'class_professor' => $c->class_professor,
            ];
        });
        return view('calendar', compact('classSchedule'));
    }

    public function showManageSchedule(){
        $classSchedule = Schedule::all()->map(function ($c){
            return (object)[
                'sched_id' => $c->sched_id,
                'day'     => $c->day,
                'class_subject' => $c->class_subject,
                'time'    => \Carbon\Carbon::parse($c->time_start)->format('g:i A') 
                           . ' – ' . 
                           \Carbon\Carbon::parse($c->time_end)->format('g:i A'),
                'time_start'    => $c->time_start,
                'time_end'    => $c->time_end,
                'class_location'    => $c->class_location,
                'class_professor' => $c->class_professor,
            ];
        });
        return view('schedule', compact('classSchedule'));
    }

    public function addSchedule(Request $request){
        Schedule::create([
            'class_subject' => $request->class_subject
           ,'class_professor' => $request->class_professor
           ,'class_location' => $request->class_location
           ,'day' => $request->day
           ,'time_start' => $request->time_start
           ,'time_end' => $request->time_end
        ]);

        return back()->with('success', 'Added successfully');
    }
}
