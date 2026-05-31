@extends('layouts.dashboard')

@section('style')
<style>
    body{
        background: #f0f4f8;
        font-family: 'Nunito', sans-serif;
    }
    .d-card {
        background: #fff;
        border: 1px solid #e8eaf0;
        border-radius: 12px;
        padding: 1.25rem;
        height: 100%;
    }
    .d-card-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #8b93a7;
        margin-bottom: .75rem;
    }
    .metric-card {
        background: #f5f7fb;
        border-radius: 10px;
        padding: 1rem;
    }
    .metric-value { font-size: 26px; font-weight: 600; color: #1a1f36; }
    .metric-sub   { font-size: 12px; color: #8b93a7; margin-top: 2px; }

    .next-banner {
        background: #e8f1fd;
        border: 1px solid #b8d1f8;
        border-radius: 12px;
        padding: 1.25rem;
        height: 100%;
    }
    .next-banner .nb-label { font-size: 12px; color: #2563eb; margin-bottom: .4rem; }
    .next-banner .nb-subj  { font-size: 20px; font-weight: 600; color: #1e3a8a; margin-bottom: .35rem; }
    .next-banner .nb-meta  { font-size: 13px; color: #2563eb; flex-wrap: wrap; }
    .next-banner .nb-timer { font-size: 30px; font-weight: 700; color: #1d4ed8; margin-top: .6rem; }

    .week-strip  { display: flex; gap: 6px; }
    .week-day {
        flex: 1; text-align: center;
        padding: 6px 4px 8px;
        border-radius: 8px;
        border: 1px solid #e8eaf0;
    }
    .week-day.today { background: #e8f1fd; border-color: #b8d1f8; }
    .wd-name { font-size: 11px; color: #8b93a7; margin-bottom: 2px; }
    .week-day.today .wd-name { color: #2563eb; }
    .wd-dots { display: flex; justify-content: center; gap: 3px; margin-top: 5px; min-height: 8px; }
    .wd-dot  { width: 6px; height: 6px; border-radius: 50%; background: #2563eb; }
    .week-day.today .wd-dot { background: #1d4ed8; }

    .class-row {
        display: flex; align-items: center; gap: 10px;
        padding: 9px 0;
        border-bottom: 1px solid #f0f2f7;
    }
    .class-row:last-child { border-bottom: none; }
    .class-dot  { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; background: #2563eb; }
    .class-name { font-size: 14px; font-weight: 600; color: #1a1f36; }
    .class-meta { font-size: 12px; color: #8b93a7; margin-top: 1px; }

    .status-badge {
        font-size: 11px; padding: 3px 10px;
        border-radius: 99px; font-weight: 600; white-space: nowrap;
    }
    .badge-done     { background: #dcfce7; color: #15803d; }
    .badge-ongoing  { background: #dbeafe; color: #1d4ed8; }
    .badge-upcoming { background: #f0f2f7; color: #6b7280; }

    .sched-item {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f0f2f7;
    }
    .sched-item:last-child { border-bottom: none; }
    .sched-icon {
        width: 40px; height: 40px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; font-size: 18px;
    }
    .sched-subj { font-size: 14px; font-weight: 600; color: #1a1f36; }
    .sched-meta { font-size: 12px; color: #6b7280; margin-top: 3px; }

    .empty-note { font-size: 14px; color: #8b93a7; text-align: center; padding: 1.5rem 0; margin: 0; }
</style>
@endsection

@section('content')
<div class="container py-3">

    <div class="mb-3 border-bottom pb-3">
        <h1 class="fs-3" style="color: #1a1f36; margin: 0;">Dashboard</h1>
        <p style="font-size: 13px; color: #8b93a7; margin: 4px 0 0;">
            {{ $now->format('l, F j, Y') }}
        </p>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-12 col-md-8">
            @if ($nextClass)
                <div class="next-banner">
                    <div class="nb-label">🕐 Next class</div>
                    <div class="nb-subj">{{ $nextClass['class_subject'] }}</div>
                    <div class="nb-meta d-flex gap-3 flex-wrap">
                        <span>📍 {{ $nextClass['class_location'] }}</span>
                        <span>👤 {{ $nextClass['class_professor'] }}</span>
                        <span>🕗 {{ $nextClass['time_display'] }}</span>
                    </div>
                    <div class="nb-timer">{{ $countdown }}</div>
                </div>
            @else
                <div class="d-card d-flex align-items-center justify-content-center">
                    <p class="empty-note">No more classes today 🎉</p>
                </div>
            @endif
        </div>
        <div class="col-12 col-md-4 d-flex flex-column gap-3">
            <div class="metric-card">
                <div class="d-card-label mb-1">Classes today</div>
                <div class="metric-value">{{ $totalToday }}</div>
                <div class="metric-sub">{{ $remainingToday }} remaining</div>
            </div>
            <div class="metric-card">
                <div class="d-card-label mb-1">Total subjects</div>
                <div class="metric-value">{{ $allSchedules->count() }}</div>
                <div class="metric-sub">This semester</div>
            </div>
        </div>
    </div>

    <div class="d-card mb-3">
        <div class="d-card-label">This week</div>
        <div class="week-strip">
            @foreach ($weekStrip as $wd)
                <div class="week-day {{ $wd['isToday'] ? 'today' : '' }}">
                    <div class="wd-name">{{ substr($wd['short'], 0, 2) }}</div>
                    <div class="wd-dots">
                        @for ($i = 0; $i < min($wd['count'], 4); $i++)
                            <div class="wd-dot"></div>
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-md-6">
            <div class="d-card">
                <div class="d-card-label">Today's classes</div>
                @forelse ($todayClasses as $cls)
                    <div class="class-row">
                        <div class="class-dot"></div>
                        <div class="flex-grow-1">
                            <div class="class-name">{{ $cls['class_subject'] }}</div>
                            <div class="class-meta">
                                {{ $cls['time_display'] }} · {{ $cls['class_location'] }}
                            </div>
                        </div>
                        @if ($cls['status'] === 'done')
                            <span class="status-badge badge-done">Done</span>
                        @elseif ($cls['status'] === 'ongoing')
                            <span class="status-badge badge-ongoing">Ongoing</span>
                        @else
                            <span class="status-badge badge-upcoming">Upcoming</span>
                        @endif
                    </div>
                @empty
                    <p class="empty-note">No classes scheduled today</p>
                @endforelse
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="d-card">
                <div class="d-card-label">All schedules</div>
                @php
                    $palette = [
                        ['bg' => '#fef3c7', 'color' => '#d97706'],
                        ['bg' => '#dbeafe', 'color' => '#2563eb'],
                        ['bg' => '#fce7f3', 'color' => '#db2777'],
                        ['bg' => '#dcfce7', 'color' => '#16a34a'],
                        ['bg' => '#ede9fe', 'color' => '#7c3aed'],
                        ['bg' => '#ccfbf1', 'color' => '#0d9488'],
                        ['bg' => '#ffedd5', 'color' => '#ea580c'],
                    ];
                @endphp
                @foreach ($allSchedules as $i => $sched)
                    @php $p = $palette[$i % count($palette)]; @endphp
                    <div class="sched-item">
                        <div class="sched-icon" style="background:{{ $p['bg'] }}; color:{{ $p['color'] }};">
                            📖
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="sched-subj">{{ $sched->class_subject }}</div>
                            <div class="sched-meta">
                                📅 {{ $sched->day }} &nbsp;
                                🕗 {{ \Carbon\Carbon::parse($sched->time_start)->format('g:i A') }} – {{ \Carbon\Carbon::parse($sched->time_end)->format('g:i A') }}<br>
                                📍 {{ $sched->class_location }} · {{ $sched->class_professor }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row g-3 mt-0">

        <div class="col-12 col-md-6">
            <div class="d-card">
                <div class="d-card-label">Classes per day</div>
                <div style="position: relative; width: 100%; height: 200px;">
                    <canvas id="barChart"
                        role="img"
                        aria-label="Bar chart showing number of classes scheduled per day of the week">
                    </canvas>
                </div>
            </div>
        </div>
    
        <div class="col-12 col-md-6">
            <div class="d-card">
                <div class="d-card-label">Schedule heatmap</div>
                <div id="scheduleHeatmap"></div>
            </div>
        </div>
    
    </div>
</div>


@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const weekStrip = @json($weekStrip); 
    const allSchedules = @json($allSchedules->values());
    const today = @json($now->format('l'));

    const labels  = weekStrip.map(w => w.short.slice(0, 2));
    const counts  = weekStrip.map(w => w.count);
    const bgColors = weekStrip.map(w =>
        w.isToday ? '#1d4ed8' : '#93c5fd'
    );

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Classes',
                data: counts,
                backgroundColor: bgColors,
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.raw} class${ctx.raw !== 1 ? 'es' : ''}`
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: { color: '#8b93a7', font: { size: 11 } }
                },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, color: '#8b93a7', font: { size: 11 } },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                }
            }
        }
    });

    const heatmapDays = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
    const timeSlots   = ['7:00','8:00','9:00','10:00','11:00','12:00',
                         '13:00','14:00','15:00','16:00','17:00','18:00','19:00'];
    const timeLabels  = ['7AM','8AM','9AM','10AM','11AM','12PM',
                         '1PM','2PM','3PM','4PM','5PM','6PM','7PM'];

    const lookup = {};
    allSchedules.forEach(s => {
        const dayFull = s.day;
        const startH  = s.time_start.slice(0, 5);
        if (!lookup[dayFull]) lookup[dayFull] = [];
        lookup[dayFull].push(startH);
    });

    const dayFullMap = {
        Mon: 'Monday', Tue: 'Tuesday', Wed: 'Wednesday',
        Thu: 'Thursday', Fri: 'Friday', Sat: 'Saturday', Sun: 'Sunday'
    };

    const container = document.getElementById('scheduleHeatmap');
    container.style.cssText = 'display:flex; flex-direction:column; gap:3px;';

    const header = document.createElement('div');
    header.style.cssText = 'display:flex; gap:3px; padding-left:36px;';
    heatmapDays.forEach(d => {
        const cell = document.createElement('div');
        cell.style.cssText = 'flex:1; text-align:center; font-size:10px; color:#8b93a7; font-weight:600;';
        cell.textContent = d;
        header.appendChild(cell);
    });
    container.appendChild(header);

    timeSlots.forEach((slot, idx) => {
        const row = document.createElement('div');
        row.style.cssText = 'display:flex; align-items:center; gap:3px;';

        const lbl = document.createElement('div');
        lbl.style.cssText = 'width:32px; font-size:9px; color:#8b93a7; text-align:right; padding-right:4px; flex-shrink:0;';
        lbl.textContent = timeLabels[idx];
        row.appendChild(lbl);

        heatmapDays.forEach(short => {
            const full    = dayFullMap[short];
            const isToday = full.toLowerCase() === today.toLowerCase();
            const classes = lookup[full] || [];
            const hasClass = classes.some(t => {
                return parseInt(t) === parseInt(slot);
            });

            const cell = document.createElement('div');
            cell.style.cssText = `
                flex: 1;
                height: 14px;
                border-radius: 3px;
                background: ${hasClass
                    ? (isToday ? '#1d4ed8' : '#93c5fd')
                    : '#f0f4f8'};
            `;
            row.appendChild(cell);
        });

        container.appendChild(row);
    });

});
</script>
@endsection