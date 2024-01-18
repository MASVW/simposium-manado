<?php $id=1; $title="Login"?>
@extends('layouts.main') 
@section('reset-password')
<div id="contact" class="contact-us section my-5">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    
                    <form id="contact" class="my-5" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="col-lg-12">
                            <div class="fill-form">
                                <div class="row">
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                    <h3 class="text-enter my-4">Reset Sandi</h3>
                                    <div class="d-flex justify-content-center my-0 py-0">
                                        <div class="col-lg-8">
                                            <div class="form-text text-start" id="basic-addon4">
                                                <caption>
                                                    Lupa sandi? Jangan khawatir. Silakan isi formulir di bawah ini untuk mereset kata sandi Anda.
                                                </caption>
                                            </div> 
                                        </div>
                                    </div>
    
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
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-center">
                                        <div class="col-lg-5">
                                            <button type="submit">Email Reset Link</button>
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
