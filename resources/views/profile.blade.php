@extends('layouts.dashboard')
@section('content')
<div class="container mt-4">
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4 pb-4 mb-4 border-bottom">
                    <img src="uploads/{{ $user->profile_picture}}"
                        alt="user-avatar"
                        class="d-block rounded"
                        style="width: 100px; height: 100px; object-fit: cover;"
                        id="uploadedAvatar"
                        onerror="this.src='img/5.png'"/>
                    <div>
                        <div class="d-flex flex-wrap gap-2 mb-2">   
                        <form method="post" action="/updatePicture" enctype="multipart/form-data">
                            @csrf
                            <label for="upload" class="bg-primary mb-2 d-flex" tabindex="0">
                                <!-- <span class="d-none d-sm-inline">Choose File</span> -->
                                <i class="bx bx-upload d-inline d-sm-none"></i>
                                <input type="file" id="upload" name="profile_pic" class="account-file-input text-white" accept="image/png, image/jpeg, image/gif, image/webp"/>
                            </label>
                            <button name="uploadSubmit" class="btn btn-outline-secondary">
                                <span class="d-none d-sm-inline">Change Photo</span>
                                <i class="bx bx-reset d-inline d-sm-none"></i>
                            </button>
                        </form>
                        </div>
                        <small class="text-muted">Allowed JPG, JPEG, PNG.</small>
                    </div>
                </div>

                <form    method="post" action="/updateProfile">
                    @csrf
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstName" class="form-label">Full Name</label>
                                <input class="form-control" type="text" id="firstName" name="fullname"
                                    value="{{$user->fullname}}" required autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="phonenumber" class="form-label">Phone Number</label>
                                <input class="form-control" type="text" id="middleName" name="phoneNumber"
                                    value="{{$user->phone_number}}" />
                            </div>
                            <div class="mb-3">
                                <label for="adress" class="form-label">Address</label>
                                <input class="form-control" type="text" id="address" name="address"
                                    value="{{$user->address}}" required />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Short Bio </label>
                                <textarea class="form-control" name="bio" id="">{{$user->short_bio}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" type="email" id="email" name="email"
                                    value="{{ $user->email }}" required/>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Current Password</label>
                                <input class="form-control" type="password" id="currentPassword" name="currentPassword"
                                    value=""/>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">New Password</label>
                                <input class="form-control" type="text" id="newPassword" name="newPassword"
                                    value=""/>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Confirm Password</label>
                                <input class="form-control" type="password" id="confirmPassword" name="confirmPassword"
                                    value=""/>
                            </div>
                        </div>
                    </div>  
                    <div class="d-flex gap-2 mt-3 pt-3 border-top">
                        <input type="hidden" name="id" value="">
                        <button type="submit" name="updateSubmit" class="btn btn-primary">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection