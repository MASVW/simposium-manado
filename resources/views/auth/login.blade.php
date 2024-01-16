<?php $id=1; $title="Login"?>
@extends('layouts.main') @section('login')
<div id="contact" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 ">
                <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
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
                </div>
            </div>
            <div class="d-flex justify-content-center">
            <div class="col-lg-8 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                
                <form id="contact" method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="col-lg-12">
                            <div class="fill-form">
                                <div class="row">
                                    <h3 class="text-center my-4">Masuk ke Simposium Manado</h3>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-center">
                                            <div class="col-lg-6">
                                                <div class="custom-button">
                                                    <a href="auth/google" class="btn btn-outline-primary">Masuk dengan Google <i class="bi bi-google mx-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center my-3">
                                        <div class="col-lg-8">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-0">
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <p class="text-start text-dark">Alamat Surel</p>
                                                <input
                                                    value="{{old('email')}}"
                                                    class="my-0 @error('email') is-invalid @enderror"
                                                    type="email"
                                                    name="email"
                                                    placeholder="Masukkan alamat surel"
                                                    autofocus="autofocus"
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
                                                    class="my-0 @error('password') is-invalid @enderror"
                                                    type="password"
                                                    name="password"
                                                    placeholder="Masukkan sandi"
                                                    required="true">
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </fieldset>
                                            <div class="d-flex justify-content-left mt-0">
                                                <a href="{{ route('password.request') }}" class="btn btn-link" style="font-size:small;">Lupa Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-center">
                                        <div class="col-lg-6">
                                            <button type="submit">Masuk</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="d-flex justify-content-center my-3">
                                        <div class="col-lg-8">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-0">
                                        <div class="col-lg-5 mt-0 mb-5">
                                                <p>Belum punya akun?<a href="{{ route('register') }}" class="btn btn-link" style="font-size:small;">Buat akun sekarang</a></p>
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