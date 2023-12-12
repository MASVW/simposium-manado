<?php

use App\Models\User;

 $dataId = auth()->user()->email;
 $data = User::where('email', $dataId)->first();
?>
@extends('layouts.main') @section('editProfile')
@if($menu == 1)
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
                </div>
            </div>
            <div
                class="col-lg-12 wow fadeInUp"
                data-wow-duration="0.5s"
                data-wow-delay="0.25s">
                
                <form id="contact" action="/profile/edit" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-dec">
                                <img src="assets/images/contact-dec-v3.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="fill-form">
                                <div class="row">
                                <div
                                    class="section-heading wow fadeIn"
                                    data-wow-duration="1s"
                                    data-wow-delay="0.5s">
                                    <h2 class="primary">Edit Profile</h2>
                                    <div class="line-dec"></div>
                                </div>
                                    <div class="col-md-6 offset-md-3">
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">First Name</p>
                                            <input
                                                value="{{old('firstName', $data->firstName)}}"
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
                                                value="{{ old('lastName', $data->lastName)}}"
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
                                                value="{{old('email', $data->email)}}"
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
                                                value="{{old('birthDate', $data->birthDate)}}"
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
                                    </div>
                                    <div class="d-flex justify-content-center mt-5">
                                        <div class="col-lg-5">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="btn btn-primary">Save!</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                    </form>
                                    <form action="/profile/edit/pass" method="get">
                                        @csrf
                                        <div class="d-flex justify-content-center mt-3">
                                            <div class="col-lg-5">
                                                <fieldset>
                                                    <button type="submit" id="form-submit" class="second-button mt-0">Change Password</button>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>
@elseif($menu == 2)
<div id="contact" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
            </div>
            <div
                class="col-lg-12 wow fadeInUp"
                data-wow-duration="0.5s"
                data-wow-delay="0.25s">
                
                <form id="contact" action="/profile/edit/pass" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-dec">
                                <img src="assets/images/contact-dec-v3.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="fill-form">
                                <div class="row">
                                <div
                                    class="section-heading wow fadeIn"
                                    data-wow-duration="1s"
                                    data-wow-delay="0.5s">
                                    <h2 class="primary">Edit Password</h2>
                                    <div class="line-dec"></div>
                                </div>
                                    <div class="col-md-6 offset-md-3">
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Old Password</p>
                                            <input
                                                class="form-control @error('oldPass') is-invalid @enderror my-0"
                                                type="password"
                                                name="oldPass"
                                                placeholder="Old Password"
                                                autocomplete="on"
                                                required="true">
                                            @error('oldPass')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">New Password</p>
                                            <input
                                                class="form-control @error('newPass') is-invalid @enderror my-0"
                                                type="password"
                                                name="newPass"
                                                placeholder="New Password"
                                                autocomplete="on"
                                                required="true">
                                            @error('newPass')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Confirm New Password</p>
                                            <input
                                                class="form-control @error('confPass') is-invalid @enderror my-0"
                                                type="password"
                                                name="confPass"
                                                placeholder="New Password"
                                                required="true">
                                            @error('confPass')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    <div class="d-flex justify-content-center mt-5">
                                        <div class="col-lg-5">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="btn btn-primary">Change Password</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>
@endif

@endsection