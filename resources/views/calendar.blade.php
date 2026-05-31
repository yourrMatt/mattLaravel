@extends('layouts.dashboard')
@section('style')
    <style>
        body {
        background: #f0f4f8;
        font-family: 'Nunito', sans-serif;
        }

        .calendar-section {
        background: #fff;
        border-radius: 14px;
        padding: 1.4rem 1.2rem 1.2rem;
        box-shadow: 0 2px 16px rgba(0,0,0,0.07);
        max-width: 310px;
        height: 320px;
        }

        .calendar-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: #1565C0;
        margin-bottom: 1rem;
        }

        .search-wrap {
        position: relative;
        margin-bottom: 1rem;
        }
        .search-wrap input {
        width: 100%;
        padding: 9px 36px 9px 12px;
        border: 1.5px solid #dde3ec;
        border-radius: 8px;
        font-size: 0.85rem;
        font-family: 'Nunito', sans-serif;
        outline: none;
        transition: border-color .2s;
        color: #374151;
        }
        .search-wrap input:focus { border-color: #1976D2; }
        .search-wrap .search-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1rem;
        pointer-events: none;
        }

        .day-selector {
        background: #f5f7fa;
        border-radius: 10px;
        padding: 1rem 0.8rem;
        margin-bottom: 1rem;
        }

        .day-selector-title {
        font-size: 0.78rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 0.75rem;
        }

        .days-row {
        display: flex;
        justify-content: space-between;
        gap: 4px;
        }

        .day-btn {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        }

        .day-letter {
        font-size: 0.72rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        }

        .day-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        color: #374151;
        background: #fff;
        border: 1.5px solid transparent;
        transition: all .18s ease;
        }

        .day-btn:hover .day-circle {
        background: #e3eeff;
        color: #1976D2;
        border-color: #90b8f8;
        }

        .day-btn.active .day-letter { color: #1976D2; }
        .day-btn.active .day-circle {
        background: #1976D2;
        color: #fff;
        border-color: #1976D2;
        box-shadow: 0 2px 8px rgba(25,118,210,0.35);
        }

        .day-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #1976D2;
        margin-top: 2px;
        visibility: hidden;
        }
        .day-btn.today .day-dot { visibility: visible; }

        .classes-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        max-height: 320px;
        overflow-y: auto;
        padding-right: 2px;
        }
        .classes-list::-webkit-scrollbar { width: 4px; }
        .classes-list::-webkit-scrollbar-thumb { background: #dde3ec; border-radius: 4px; }

        .class-card {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: #f8fafc;
        border-radius: 10px;
        padding: 0.65rem 0.8rem;
        border: 1.5px solid #edf2f7;
        transition: border-color .18s, box-shadow .18s;
        animation: fadeSlide 0.25s ease both;
        }
        .class-card:hover {
        border-color: #90b8f8;
        box-shadow: 0 2px 10px rgba(25,118,210,0.09);
        }

        @keyframes fadeSlide {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
        }

        .class-color-bar {
        width: 4px;
        min-height: 48px;
        border-radius: 4px;
        flex-shrink: 0;
        margin-top: 2px;
        }

        .class-info { flex: 1; }

        .class-name {
        font-size: 0.82rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 3px;
        }

        .class-meta {
        font-size: 0.73rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 2px;
        }
        .class-meta svg { flex-shrink: 0; }

        .no-class {
        text-align: center;
        padding: 1.5rem 0;
        color: #9ca3af;
        font-size: 0.82rem;
        }

        .submission-btn {
        display: block;
        width: 100%;
        padding: 10px;
        background: #1976D2;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 0.88rem;
        font-weight: 700;
        font-family: 'Nunito', sans-serif;
        cursor: pointer;
        margin-top: 1rem;
        transition: background .18s, box-shadow .18s;
        letter-spacing: 0.01em;
        }
        .submission-btn:hover {
        background: #1565C0;
        box-shadow: 0 3px 12px rgba(25,118,210,0.3);
        }

        .events-panel {
        flex: 1;
        padding-left: 2rem;
        }
        .events-panel h5 {
        font-size: 1rem;
        font-weight: 800;
        color: #1976D2;
        margin-bottom: 0.2rem;
        }
        .events-panel .sub {
        font-size: 0.8rem;
        color: #6b7280;
        margin-bottom: 1rem;
        }
        .event-card {
        display: flex;
        align-items: center;
        gap: 14px;
        background: #f8fafc;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        margin-bottom: 0.65rem;
        border: 1.5px solid #edf2f7;
        }
        .event-thumb {
        width: 56px;
        height: 56px;
        background: #e2e8f0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #94a3b8;
        }
        .event-details .ev-name { font-size: 0.85rem; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
        .event-details .ev-meta { font-size: 0.73rem; color: #64748b; display: flex; align-items: center; gap: 5px; margin-bottom: 2px; }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-center">   
        <div class="container">
            <div class="col mb-5 mt-3 border-bottom pb-3">
                <h1 class="fs-3">Class Schedule</h1>
                <p style="font-size: 13px; color: #8b93a7; margin: 4px 0 0;">
                    Show class schedule in calendar
                </p>
            </div>
            <div class="d-flex flex-wrap gap-4">
 
            <div class="row w-100">
                <div class="d-flex flex-wrap gap-4">
    
                    <div class="calendar-section">
                        <h4 class="calendar-title">Calendar</h4>
                    
                        <div class="search-wrap">
                            <input type="text" id="schedSearch" placeholder="Search classes..." oninput="filterClasses()"/>
                            <span class="search-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            </span>
                        </div>
                    
                        <div class="day-selector">
                            <div class="day-selector-title">Select Day</div>
                            <div class="days-row" id="daysRow"></div>
                        </div>
                    
                        <button class="submission-btn" onclick="showAllClasses()">See All Classes</button>
                    </div>

                    <div class="events-panel">
                        <h5 id="panelTitle">All Classes</h5>
                        <p class="sub" id="panelSub">Showing all scheduled classes</p>
                        <div id="allEventsList"></div>
                    </div>
                
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
<script>

    const DAYS = [
        { key: 'M', label: 'Mon', full: 'Monday' },
        { key: 'T', label: 'Tue', full: 'Tuesday' },
        { key: 'W', label: 'Wed', full: 'Wednesday' },
        { key: 'H', label: 'Thu', full: 'Thursday' },
        { key: 'F', label: 'Fri', full: 'Friday' },
        { key: 'S', label: 'Sat', full: 'Saturday' },
    ];

    const todayJs  = new Date().getDay();
    const todayIdx = todayJs === 0 ? -1 : todayJs;

    const CLASS_COLORS = [
        '#4ecdc4', '#fbbf24', '#f472b6', '#60a5fa',
        '#a78bfa', '#34d399', '#f87171', '#fb923c',
    ];

    const CLASSES = @json($classSchedule).map(c => ({
        ...c,
        color: randomColor()
    }));

    let selectedDay = todayIdx >= 1 ? todayIdx : 1;
    let searchQuery = '';

    function randomColor() {
        return CLASS_COLORS[Math.floor(Math.random() * CLASS_COLORS.length)];
    }

    function renderDays() {
        const row = document.getElementById('daysRow');
        row.innerHTML = DAYS.map((d, i) => {
            const dayNum = i + 1;
            return `
                <button class="day-btn ${dayNum === selectedDay ? 'active' : ''} ${dayNum === todayIdx ? 'today' : ''}"
                        onclick="selectDay(${dayNum})">
                <span class="day-letter">${d.key}</span>
                <span class="day-circle">${d.label.slice(0,2)}</span>
                <span class="day-dot"></span>
                </button>
            `;
        }).join('');
    }

    function renderPanel(dayIdx, all) {
        const title = document.getElementById('panelTitle');
        const sub   = document.getElementById('panelSub');
        const cont  = document.getElementById('allEventsList');

        let items = all ? CLASSES : CLASSES.filter(c => c.day === dayIdx);

        if (searchQuery) {
            const q = searchQuery.toLowerCase();
            items = items.filter(c =>
                c.class_subject.toLowerCase().includes(q) ||
                c.class_professor.toLowerCase().includes(q) ||
                c.class_location.toLowerCase().includes(q)
            );
        }

        title.textContent = all ? 'All Classes' : `${DAYS[dayIdx - 1].full} Classes`;
        sub.textContent   = all
            ? 'Showing all scheduled classes'
            : `Showing classes for ${DAYS[dayIdx - 1].full}`;

        cont.innerHTML = items.map(c => `
            <div class="event-card">
            <div class="event-thumb" style="background:${c.color}22; color:${c.color}">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
            </div>
            <div class="event-details">
                <div class="ev-name">${c.class_subject}</div>
                <div class="ev-meta">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="${c.color}" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                ${DAYS[c.day - 1].full}
                </div>
                <div class="ev-meta">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="${c.color}" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                ${c.time}
                </div>
                <div class="ev-meta">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="${c.color}" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                ${c.class_location} · ${c.class_professor}
                </div>
            </div>
            </div>
        `).join('');
    }

    function selectDay(idx) {
        selectedDay = idx;
        renderDays();
        renderPanel(idx, false);
    }

    function filterClasses() {
        searchQuery = document.getElementById('schedSearch').value.trim();
        renderPanel(selectedDay, false);
    }

    function showAllClasses() {
        renderPanel(selectedDay, true);
    }

    renderDays();
    renderPanel(selectedDay, false);
</script>

@endsection