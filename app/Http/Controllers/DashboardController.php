<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;

class DashboardController extends Controller
{

    private const DAY_MAP = [
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
        7 => 'Sunday',
    ];

    public function index()
    {
        $now   = Carbon::now();
        $today = $now->format('l');

        $allSchedules = Schedule::all()->map(function ($s) {
            
            if (is_numeric($s->day)) {
                $s->day = self::DAY_MAP[(int) $s->day] ?? $s->day;
            }
            return $s;
        });

        $todayClasses = $allSchedules
            ->filter(fn($s) => strtolower($s->day) === strtolower($today))
            ->map(fn($s) => $this->withStatus($s, $now))
            ->sortBy('start_carbon')
            ->values();

        $nextClass = $todayClasses->first(fn($s) => $s['end_carbon']->gt($now));

        $countdown = null;
        if ($nextClass) {
            $start = $nextClass['start_carbon'];
            $countdown = $now->lt($start)
                ? 'in ' . $now->diffForHumans($start, ['syntax' => Carbon::DIFF_RELATIVE_TO_NOW, 'parts' => 1])
                : 'Ongoing now';
        }

        $weekDays  = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
        $weekStrip = collect($weekDays)->map(fn($day) => [
            'day'     => $day,
            'short'   => substr($day, 0, 3),
            'isToday' => strtolower($day) === strtolower($today),
            'count'   => $allSchedules->filter(fn($s) => strtolower($s->day) === strtolower($day))->count(),
        ]);

        $totalToday     = $todayClasses->count();
        $doneToday      = $todayClasses->filter(fn($s) => $s['status'] === 'done')->count();
        $remainingToday = $totalToday - $doneToday;

        return view('analytics', compact(
            'allSchedules',
            'todayClasses',
            'nextClass',
            'countdown',
            'weekStrip',
            'totalToday',
            'remainingToday',
            'now',
        ));
    }

    private function withStatus(Schedule $s, Carbon $now): array
    {
        $start = Carbon::parse($s->time_start);
        $end   = Carbon::parse($s->time_end);

        $status = match(true) {
            $end->lt($now)                       => 'done',
            $start->lte($now) && $end->gt($now)  => 'ongoing',
            default                              => 'upcoming',
        };

        return array_merge($s->toArray(), [
            'start_carbon' => $start,
            'end_carbon'   => $end,
            'status'       => $status,
            'time_display' => $start->format('g:i A') . ' – ' . $end->format('g:i A'),
            'day'          => $s->day,
        ]);
    }
}