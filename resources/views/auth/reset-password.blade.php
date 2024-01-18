<?php $id=1; $title="Login"?>
@extends('layouts.main') 
@section('reset-password-form')
<div id="contact" class="contact-us section my-5">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    
                    <form id="contact" class="my-5" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="col-lg-12">
                            <div class="fill-form">
                                <div class="row">
                                    <h3>Reset Sandi</h3>
                                    <div class="d-flex justify-content-center my-0">
                                        <div class="col-lg-8">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-0">
                                        <div class="col-lg-8">
                                            <fieldset>
                                                <p class="text-start text-dark">Alamat Surel</p>
                                                <input
                                                    id="email"
                                                    value="{{old('email')}}"
                                                    class="my-0 @error('email') is-invalid @enderror"
                                                    type="email"
                                                    name="email"
                                                    placeholder="Masukkan alamat surel"
                                                    autofocus
                                                    autocomplete="email"
                                                    required="true">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="mt-4">
                                                        <p class="text-start text-dark">Sandi</p>
                                                        <input
                                                            class="form-control @error('password') is-invalid @enderror my-0"
                                                            type="Password"
                                                            name="password"
                                                            placeholder="Masukkan sandi"
                                                            autocomplete="on"
                                                            required="true" caption>
                                                        @error('password')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </fieldset>
                                                    <fieldset class="mt-4">
                                                        <p class="text-start text-dark">Konfirmasi Sandi</p>
                                                        <input
                                                            class="form-control @error('password') is-invalid @enderror my-0"
                                                            type="Password"
                                                            name="password_confirmation"
                                                            placeholder="Konfirmasi sandi"
                                                            autocomplete="on"
                                                            required="true" caption>
                                                        <div class="form-text text-start" id="basic-addon4">
                                                            <ul>
                                                                <li>*Gabungan huruf besar & kecil, minimal 8 karakter</li>
                                                                <li>*Mencakup angka</li>
                                                            </ul>
                                                        </div>
                                                        @error('password_confirmation')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </fieldset>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-center">
                                        <div class="col-lg-5">
                                            <button type="submit">Reset Sandi</button>
                                        </form>
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
</div>
@endsection
