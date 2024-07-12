@extends('index') 

@section('page-title', 'Register')

@section('auth-content')
<div class="container mt-5">

    <div class="row w-100">
        <div class="col d-flex flex-col justify-content-center">
            <form method="POST" action="{{ route('register') }}" class="w-50">
                @csrf
                <h3>Register User</h3>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">Register</button>

                </div>
                <a href="{{ route('register.form') }}" class="btn btn-link w-100">Login instead</a>
            </form>
        </div>
    </div>
</div>
@endsection