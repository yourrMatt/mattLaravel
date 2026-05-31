@extends('layouts.auth')
@section('title')
    Signup
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card p-5" style="width: 30rem;">
        <form  method="POST" action="/signup">
            @csrf
            <h1 class="mb-3">Sign up</h1>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Fullname</label>
                <input type="text" class="form-control" name="fullname" id="exampleFormControlInput1" placeholder="St. Peter" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="Email@gmail.com" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput2" class="form-label">Password</label>
                <input type="text" class="form-control" name="password" id="exampleFormControlInput2" placeholder="********" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput2" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="exampleFormControlInput2" placeholder="********" required>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" name="signup" class="btn btn-outline-warning px-5 w-100 my-3" style=" height: 40px;">Sign up</button>
                <a href="/login" class="mt-3 text-center">Already have an account?</a>
            </div>
        </form>
    </div>
</div>
@endsection