@extends('layouts.dashboard')
@section('content')
    <div class="container d-flex justify-content-center">
        <div class="row w-100">
            <div class="col d-flex justify-content-between mb-5 mt-3 border-bottom pb-3">
                <h1 class="fs-3">Manage Users</h1>
                <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addUser">Add new users</button>
            </div>
            <table class="table shadow">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->fullname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editUser{{$user->id}}'>Edit</button>
                                    <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteUser{{$user->id}}'>Archive</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="editUser{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/editUser">
                                            @csrf
                                            <input type="hidden" name="hiddenId" class="form-control" id="id" value="{{$user->id}}">

                                            <div class="mb-3">
                                                <label for="fname" class="form-label">Full Name</label>
                                                <input type="text" name="fullname" class="form-control" id="fname" value="{{$user->fullname}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="role" class="form-label">Role</label>
                                                <select class="form-select" name="role" aria-label="Default select example">
                                                    <option {{ $user->role == '' ? 'selected' : '' }} value="Admin">Select Role</option>
                                                    <option {{ $user->role == 'Admin' ? 'selected' : '' }} value="Admin">Admin</option>
                                                    <option {{ $user->role == 'User' ? 'selected' : '' }} value="User">User</option>
                                                </select>
                                            </div>           
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" name="status" aria-label="Default select example">
                                                    <option {{ $user->status == '' ? 'selected' : '' }} value="Admin">Select Status</option>
                                                    <option {{ $user->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                                                    <option {{ $user->status == 'inactive' ? 'selected' : '' }} value="inactive">Inactive</option>
                                                </select>
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

                            <div class="modal fade" id="deleteUser{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this user?</p>
                                        <p>Fullname: {{$user->fullname}}</p>
                                        <p>Email: {{$user->email}}</p>
                                        <p>Role: {{ $user->role }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post" action="/archiveUser">
                                            @csrf
                                            <input type="hidden" name="hiddenId" value="{{ $user->id }}">
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
                <form method="post" action="/addUser">
                    @csrf
                    <div class="mb-3">
                        <label for="fname" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="fullname" id="fname" placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Role</label>
                        <select class="form-select" name="role" aria-label="Default select example">
                            <option selected value="User">User</option>
                        </select>
                    </div>           
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="addSubmit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection