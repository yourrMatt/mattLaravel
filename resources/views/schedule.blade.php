@extends('layouts.dashboard')
@section('style')
    <style>
        body{
            background: #f0f4f8;
            font-family: 'Nunito', sans-serif;
        }
    </style>

@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="container">
            <div class="d-flex justify-content-between mb-5 mt-3 border-bottom pb-3">
                <div class="col">
                    <h1 class="fs-3">Manage Schedule</h1>
                    <p style="font-size: 13px; color: #8b93a7; margin: 4px 0 0;">
                        Show class schedule in calendar
                    </p>
                </div>
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">Add class schedule</button>
                </div>
            </div>
            <table class="table shadow">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Subject Code</th>
                        <th>Professor</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Room</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($classSchedule as $sched)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sched->class_subject}}</td>
                                <td>{{ $sched->class_professor }}</td>
                                <td>
                                    @switch($sched->day)
                                        @case(1) Monday @break
                                        @case(2) Tuesday @break
                                        @case(3) Wednesday @break
                                        @case(4) Thursday @break
                                        @case(5) Friday @break
                                        @case(6) Saturday @break
                                        @default N/A
                                    @endswitch
                                </td>
                                <td>{{ $sched->time }}</td>
                                <td>{{ $sched->class_location }}</td>
                                <td>
                                    <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editUser{{$sched->sched_id}}'>Edit</button>
                                    <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteUser{{$sched->sched_id}}'>Archive</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="editUser{{$sched->sched_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Schedule</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/editSched">
                                            @csrf
                                            <input type="hidden" name="hiddenId" class="form-control" id="id" value="{{$sched->sched_id}}">

                                            <div class="mb-3">
                                                <label for="role" class="form-label">Day</label>
                                                <select class="form-select" name="day" aria-label="Default select example">
                                                    <option {{ $sched->day == '' ? 'selected' : '' }} value="Admin">Select Day</option>
                                                    <option {{ $sched->day == '1' ? 'selected' : '' }} value="1">Monday</option>
                                                    <option {{ $sched->day == '2' ? 'selected' : '' }} value="2">Tuesday</option>
                                                    <option {{ $sched->day == '3' ? 'selected' : '' }} value="3">Wednesday</option>
                                                    <option {{ $sched->day == '4' ? 'selected' : '' }} value="4">Thursday</option>
                                                    <option {{ $sched->day == '5' ? 'selected' : '' }} value="5">Friday</option>
                                                    <option {{ $sched->day == '6' ? 'selected' : '' }} value="6">Saturday</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="sub" class="form-label">Subject Code</label>
                                                <input type="text" name="class_subject" class="form-control" id="sub" value="{{$sched->class_subject}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-6 mb-3">
                                                    <label for="prof" class="form-label">Professor</label>
                                                    <input type="text" name="class_professor" class="form-control" id="prof" value="{{$sched->class_professor}}">
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="loc" class="form-label">Location</label>
                                                    <input type="text" name="class_location" class="form-control" id="loc" value="{{$sched->class_location}}">
                                                </div> 
                                            </div>   

                                            <div class="row">
                                                <div class="col-6 mb-3">
                                                    <label for="tstart" class="form-label">Time Start</label>
                                                    <input type="time" name="time_start" class="form-control" id="tstart" value="{{$sched->time_start}}">
                                                </div>        
                                                <div class="col-6 mb-3">
                                                    <label for="email" class="form-label">Time End</label>
                                                    <input type="time" name="time_end" class="form-control" id="email" value="{{$sched->time_end}}">
                                                </div>    
                                            </div>    
                                        
                                    </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="updateSubmit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deleteUser{{$sched->sched_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this schedule?</p>
                                        <p>Subject Code: {{$sched->class_subject}}</p>
                                        <p>Day: {{$sched->day}}</p>
                                        <p>Time: {{ $sched->time }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post" action="/archiveSched">
                                            @csrf
                                            <input type="hidden" name="hiddenId" value="{{ $sched->sched_id }}">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </form> 
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach 
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/addSchedule">
                    @csrf
                    <div class="mb-3">
                        <label for="role" class="form-label">Day</label>
                        <select class="form-select" name="day" aria-label="Default select example">
                            <option value="Admin">Select Day</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sub" class="form-label">Subject Code</label>
                        <input type="text" name="class_subject" class="form-control" id="sub" placeholder="ICT 101">
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="prof" class="form-label">Professor</label>
                            <input type="text" name="class_professor" class="form-control" id="prof" placeholder="Mr. Dela Cruz">
                        </div>    
                        <div class="col-6 mb-3">
                            <label for="loc" class="form-label">Location</label>
                            <input type="text" name="class_location" class="form-control" id="loc" placeholder="S-101">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="tstart" class="form-label">Time Start</label>
                            <input type="text" name="time_start" class="form-control" id="tstart" value="" onfocus="this.type='time'" onblur="if(!this.value) this.type='text'" placeholder="e.g. 07:00 AM">
                        </div>        
                        <div class="col-6 mb-3">
                            <label for="tend" class="form-label">Time End</label>
                            <input type="text" name="time_end" class="form-control" id="tend" value="" onfocus="this.type='time'" onblur="if(!this.value) this.type='text'" placeholder="e.g. 10:00 AM">
                        </div> 
                    </div>
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="addSubmit" class="btn btn-primary">Add Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection