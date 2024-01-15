@extends('layouts.main') @section('login')
<div id="contact" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div
                    class="section-heading wow fadeIn"
                    data-wow-duration="1s"
                    data-wow-delay="0.5s">

                    @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif @if(session()->has('loginEror'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('loginEror') }}
                    </div>
                    @endif
                    @if(session()->has('googleError'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('googleError') }}
                    </div>
                    @endif
                    @if(session()->has('internalError'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('internalError') }}
                    </div>
                    @endif

                    <h6>Login</h6>
                    <h4>
                        <em>Hi
                        </em>Welcome Back!</h4>
                    <div class="line-dec"></div>
                </div>
            </div>
            <div
                class="col-lg-12 wow fadeInUp"
                data-wow-duration="0.5s"
                data-wow-delay="0.25s">
                
                <form id="contact" method="POST" action="/">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-dec">
                                <img src="assets/images/contact-dec-v3.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-5" style="margin-top: 2%;">
                            <div id="image">
                                <img src="assets/images/animation/login.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="fill-form">
                                <div class="row">
                                    <h1 class="text-center my-4 text-primary">Simposium Manado</h1>
                                    <div class="col-lg-7">
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Email</p>
                                            <input
                                                value="{{old('email')}}"
                                                class="my-0 @error('email') is-invalid @enderror"
                                                type="email"
                                                name="email"
                                                placeholder="Email"
                                                autofocus="autofocus"
                                                required="true">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Password</p>
                                            <input
                                                class="my-0 @error('password') is-invalid @enderror"
                                                type="password"
                                                name="password"
                                                placeholder="Password"
                                                required="true">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-5">
                                        <p class=" text-dark  mt-4 mb-2">Login With Google</p>
                                        <div class="d-flex justify-content-center">
                                            <a href="auth/google"><img src="assets/images/icon/google.png" width="auto" height="50px"></a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-5">
                                    <div class="flex items-center justify-end mt-4">
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-lg-5">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="main-button mt-0">Login</button>
                                            </fieldset>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection