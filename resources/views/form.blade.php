<?php use App\Models\Position;?>
@extends('layouts.main') @section('form')

@if(!$data)
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
                
                <form id="contact" action="/{{$payment}}/fillForm" method="post">
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
                                    <h2 class="primary">Fill Form</h2>
                                    @foreach ($bucket as $bucket)
                                    <div class="line-dec"></div>
                                </div>
                                    <div class="col-md-6 offset-md-3">
                                        Information<br>
                                        <span>Event Name: {{$bucket->events->eventName}}</span>
                                        <br>
                                        <span>Bundle Name: {{$bucket->prices->priceTag}}</span>
                                        <br>
                                        <span>Event Date: {{$bucket->events->eventDate}}</span>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Nama Lengkap</p>
                                            <input
                                            value=""
                                                class="form-control @error('fullName') is-invalid @enderror my-0"
                                                type="text"
                                                name="fullName?{{$bucket->id}}"
                                                placeholder="Nama Lengkap"
                                                autocomplete="on"
                                                required="true">
                                            <div class="form-text text-start" id="basic-addon4">
                                                <ul>
                                                    <li>*Sertakan gelar Anda, misalnya <span style="color: #4da6e7;">M.Biomed</span>, <span style="color: #4da6e7;">dr. </span></li>
                                                </ul>
                                            </div>
                                            @error('fullName')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Nomor Telepon</p>
                                            <input
                                                class="form-control @error('phone') is-invalid @enderror my-0"
                                                type="text"
                                                name="phone?{{$bucket->id}}"
                                                placeholder="Phone"
                                                autocomplete="on"
                                                required="true">
                                            <div class="form-text text-start" id="basic-addon4">
                                                <ul>
                                                    <li>*Masukkan nomor WhatsApp aktif Anda, ini penting untuk menghubungi Anda</li>
                                                </ul>
                                            </div>
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Asal Instansi</p>
                                            <input
                                                class="form-control @error('instance') is-invalid @enderror my-0"
                                                type="text"
                                                name="instance?{{$bucket->id}}"
                                                placeholder="Asal Instansi"
                                                required="true">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Alamat Surel</p>
                                            <input
                                                class="form-control @error('email') is-invalid @enderror my-0"
                                                type="email"
                                                name="email?{{$bucket->id}}"
                                                placeholder="Email"
                                                required="true">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <input type="hidden" name="jobs?{{$bucket->id}}" value="{{$bucket->prices->job_id}}">
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Job</p>
                                            <?php $job = Position::where("id", $bucket->prices->positions_id)->first()?>
                                            <select class="form-select form-select-sm mb-3" name="job_id" disabled>
                                                <option selected>Job: {{$job->desc}}</option>
                                            </select>
                                            @error('job')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    @endforeach
                                    <div class="d-flex justify-content-center mt-5">
                                        <div class="col-lg-5">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="btn btn-primary">Save!</button>
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
@else
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
                
                <form id="contact" action="/{{$payment}}/fillForm" method="post">
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
                                    <h2 class="primary">Fill Form</h2>
                                    @foreach ($bucket as $bucket)
                                    <div class="line-dec"></div>
                                </div>
                                    <div class="col-md-6 offset-md-3">
                                        Information<br>
                                        <span>Event Name: {{$bucket->events->eventName}}</span>
                                        <br>
                                        <span>Bundle Name: {{$bucket->prices->priceTag}}</span>
                                        <br>
                                        <span>Event Date: {{$bucket->events->eventDate}}</span>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Nama Lengkap</p>
                                            <input
                                            value=""
                                                class="form-control @error('fullName') is-invalid @enderror my-0"
                                                type="text"
                                                name="fullName?{{$bucket->id}}"
                                                placeholder="{{$bucket->datas->fullName}}"
                                                value="{{$bucket->datas->fullName}}"
                                                autocomplete="on"
                                                required="true">
                                            <div class="form-text text-start" id="basic-addon4">
                                                <ul>
                                                    <li>*Sertakan gelar Anda, misalnya <span style="color: #4da6e7;">M.Biomed</span>, <span style="color: #4da6e7;">dr. </span></li>
                                                </ul>
                                            </div>
                                            @error('fullName')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Nomor Telepon</p>
                                            <input
                                                class="form-control @error('phone') is-invalid @enderror my-0"
                                                type="text"
                                                name="phone?{{$bucket->id}}"
                                                placeholder="{{$bucket->datas->phone}}"
                                                value="{{$bucket->datas->phone}}"
                                                autocomplete="on"
                                                required="true">
                                            <div class="form-text text-start" id="basic-addon4">
                                                <ul>
                                                    <li>*Masukkan nomor WhatsApp aktif Anda, ini penting untuk menghubungi Anda</li>
                                                </ul>
                                            </div>
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Asal Instansi</p>
                                            <input
                                                class="form-control @error('instance') is-invalid @enderror my-0"
                                                type="text"
                                                name="instance?{{$bucket->id}}"
                                                placeholder="{{$bucket->datas->instance}}"
                                                value="{{$bucket->datas->instance}}"
                                                required="true">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Alamat Surel</p>
                                            <input
                                                class="form-control @error('email') is-invalid @enderror my-0"
                                                type="email"
                                                name="email?{{$bucket->id}}"
                                                placeholder="{{$bucket->datas->email}}"
                                                value="{{$bucket->datas->email}}"
                                                required="true">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <input type="hidden" name="jobs?{{$bucket->id}}" value="{{$bucket->prices->job_id}}">
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Job</p>
                                            <?php $job = Position::where("id", $bucket->prices->positions_id)->first()?>
                                            <select class="form-select form-select-sm mb-3" name="job_id" disabled>
                                                <option selected>Job: {{$job->desc}}</option>
                                            </select>
                                            @error('job')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    @endforeach
                                    <div class="d-flex justify-content-center mt-5">
                                        <div class="col-lg-5">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="btn btn-primary">Save!</button>
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
@endif
  

@endsection