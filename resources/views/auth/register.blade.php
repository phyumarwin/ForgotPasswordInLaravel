@extends('layouts.default')
@section("title", "Register")
@section("content")
<main class="mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @if (session()->has("success"))
                    <div class="alert alert-success">
                        {{ session()->get("success") }}
                    </div>
                @endif
                @if (session()->has("error"))
                    <div class="alert alert-danger">
                        {{ session()->get("error") }}
                    </div>
                @endif
                <div class="card">
                    <h3 class="card-header text-center">Register</h3>
                    <div class="card-body">
                        <form action="{{ route("register.post") }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Fullname"
                                        id="fullname" class="form-control" name="fullname" 
                                        autofocus>
                                @if ($errors->has('fullname'))
                                    <span class="text-danger">
                                        {{ $errors->first('fullname') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email"
                                        id="email" class="form-control" name="email" 
                                        required autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password"
                                        id="password" class="form-control" name="password" 
                                        required>
                                @if ($errors->has('password'))
                                    <span class="text-danger">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                            <div class="d-grid mx-auto">
                                <button class="btn btn-dark btn-block" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection