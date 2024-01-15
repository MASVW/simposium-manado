@extends('layouts.main') @section('changePass')
<div id="contact" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
            </div>
            <div
                class="col-lg-12 wow fadeInUp"
                data-wow-duration="0.5s"
                data-wow-delay="0.25s">
                
                <form id="contact" action="{{route('password.update')}}" method="post">
                    @method('put')
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
@endsection