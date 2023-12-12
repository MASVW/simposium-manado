<?php use App\Models\Jobs;?>
@extends('layouts.main') @section('form')

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
                                            <p class="text-start text-dark">Full Name</p>
                                            <input
                                                class="form-control @error('fullName') is-invalid @enderror my-0"
                                                type="text"
                                                name="fullName?{{$bucket->id}}"
                                                placeholder="Full Name"
                                                autocomplete="on"
                                                required="true">
                                            @error('fullName')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Phone</p>
                                            <input
                                                class="form-control @error('phone') is-invalid @enderror my-0"
                                                type="text"
                                                name="phone?{{$bucket->id}}"
                                                placeholder="Phone"
                                                autocomplete="on"
                                                required="true">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <p class="text-start text-dark">Email</p>
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
                                            <?php $job = Jobs::where("id", $bucket->prices->job_id)->first()?>
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
  

@endsection