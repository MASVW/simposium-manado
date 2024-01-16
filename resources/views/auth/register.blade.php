<?php  $id = 1; $title = 'Sign Up'; ?>
@extends('layouts.main') @section('signUp')
<div id="contact" class="contact-us section">
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-6 offset-lg-3">
                <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                    <h4>
                        <em>Halo,</em>
                        Senang bertemu denganmu!</h4>
                    <div class="line-dec"></div>
                </div>
            </div> -->
            <div class="d-flex justify-content-center">
                
                <div class="col-lg-8 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="{{route('register')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="fill-form">
                                    <div class="row">
                                        <h3 class="text-center my-4">Daftar Simposium Manado</h3>
                                        
                                        <div class="d-flex justify-content-center">
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <fieldset class="mt-4">
                                                        <p class="text-start text-dark">Nama Depan</p>
                                                        <input
                                                            value="{{old ('firstName')}}"
                                                            class="form-control @error('firstName') is-invalid @enderror my-0"
                                                            type="text"
                                                            name="firstName"
                                                            placeholder="Masukkan nama depan"
                                                            autocomplete="on"
                                                            required="true">
                                                        @error('firstName')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </fieldset>
                                                    <fieldset class="mt-4">
                                                        <p class="text-start text-dark">Nama Belakang</p>
                                                        <input
                                                            value="{{old ('lastName')}}"
                                                            class="form-control @error('lastName') is-invalid @enderror my-0"
                                                            type="text"
                                                            name="lastName"
                                                            placeholder="Masukkan nama belakang"
                                                            autocomplete="on"
                                                            required="true">
                                                        @error('lastName')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </fieldset>
                                                    <fieldset class="mt-4">
                                                        <p class="text-start text-dark">Alamat surel</p>
                                                        <input
                                                            value="{{old ('email')}}"
                                                            class="form-control @error('email') is-invalid @enderror my-0"
                                                            type="email"
                                                            name="email"
                                                            placeholder="Masukkan alamt surel"
                                                            required="true">
                                                        @error('email')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </fieldset>
                                                    <fieldset class="mt-4">
                                                        <p class="text-start text-dark">Tanggal Lahir</p>
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
                                                        @error('password')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </fieldset>

                                                </div>

                                            </div>
                                        </div>  
                                            
                                        <div class="d-flex justify-content-center mt-5">
                                            <div class="col-lg4">
                                                <fieldset>
                                                    <input type="hidden" name="isAdmin" value="false">
                                                    <button type="submit" id="form-submit" class="main-button mt-0">Daftar Sekarang!</button>
                                                </fieldset>
                                                <div class="col-lg-12">
                                                    <p class="text-start text-dark mb-0 fw-light" style="font-size:small">
                                                    Sudah punya akun? <a href="{{route('login')}}">Masuk sekarang!</a>
                                                </p>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-3">
                                            
                                        </div>
                                        <!-- <div class="d-flex justify-content-center mt-0">
                                            <br>
                                            <br>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection