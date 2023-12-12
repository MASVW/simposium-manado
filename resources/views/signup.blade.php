@extends('layouts.main') @section('signUp')
<div id="contact" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div
                    class="section-heading wow fadeIn"
                    data-wow-duration="1s"
                    data-wow-delay="0.5s">
                    <h6>Sign Up</h6>
                    <h4>
                        <em>Hi There!</em>
                        We Happy To See You!</h4>
                    <div class="line-dec"></div>
                </div>
            </div>
            <div
                class="col-lg-12 wow fadeInUp"
                data-wow-duration="0.5s"
                data-wow-delay="0.25s">
                <form id="contact" action="/signup" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-dec">
                                <img src="assets/images/contact-dec-v3.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-5" style="margin-top: 10%;">
                            <img src="assets/images/animation/signup.svg">
                        </div>
                        <div class="col-lg-7">
                            <div class="fill-form">
                                <div class="row">
                                    <h1 class="text-center my-4 text-primary">Simposium Manado</h1>
                                    <div class="col-lg-7">
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">First Name</p>
                                            <input
                                                value="{{old ('firstName')}}"
                                                class="form-control @error('firstName') is-invalid @enderror my-0"
                                                type="text"
                                                name="firstName"
                                                placeholder="First Name"
                                                autocomplete="on"
                                                required="true">
                                            @error('firstName')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Last Name</p>
                                            <input
                                                value="{{old ('lastName')}}"
                                                class="form-control @error('lastName') is-invalid @enderror my-0"
                                                type="text"
                                                name="lastName"
                                                placeholder="Last Name"
                                                autocomplete="on"
                                                required="true">
                                            @error('lastName')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Email</p>
                                            <input
                                                value="{{old ('email')}}"
                                                class="form-control @error('email') is-invalid @enderror my-0"
                                                type="email"
                                                name="email"
                                                placeholder="Email"
                                                required="true">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Birth Date</p>
                                            <input
                                                value="{{old ('birthDate')}}"
                                                class="form-control @error('birthDate') is-invalid @enderror my-0"
                                                type="date"
                                                name="birthDate"
                                                required="true">
                                            @error('birthDate')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Password</p>
                                            <input
                                                class="form-control @error('password') is-invalid @enderror my-0"
                                                type="Password"
                                                name="password"
                                                placeholder="Password"
                                                autocomplete="on"
                                                required="true" caption>
                                            <div class="form-text text-start" id="basic-addon4">
                                                <ul>
                                                    <li>*Mix of upper & lower case, 8+ characters</li>
                                                    <li>*Include a number</li>
                                                </ul>
                                            </div>
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    <div class="d-flex justify-content-center mt-5">
                                        <div class="col-lg-5">
                                            <fieldset>
                                                <input type="hidden" name="isAdmin" value="false">
                                                <button type="submit" id="form-submit" class="main-button mt-0">Sign Up!</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <div class="col-lg-5">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="second-button mt-0">Sign In</button>
                                                <p class="text-start text-dark mb-0 fw-light" style="font-size:small">Already Have An Account? Sign In Now!</p>
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