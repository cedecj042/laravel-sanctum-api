@extends('index') 

@section('page-title', 'Login')

@section('auth-content')
<div class="container mt-5">
    <div class="row">
        <div class="col d-flex flex-col justify-content-center">
            <form action="{{ route('login') }}" method="POST" style="width:500px;">
                <h3>Login User</h3>
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="{{ route('register.form') }}" class="btn btn-link">Register Now!</a>
            </form>
        </div>
    </div>
</div>
@endsection