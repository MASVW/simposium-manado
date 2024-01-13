@extends('layouts.main')

@section('invoice')

<div
    class="main-banner wow fadeIn"
    id="top"
    data-wow-duration="1s"
    data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card text-center">
                        <div class="card-header" style="background-color: white;">
                            <img src="/assets/images/animation/success_payment.svg" alt="..." height="400px">
                            </div>
                            <div class="card-body">
                            <h5 class="card-title">Your payment has been successfull</h5>
                            <p class="card-text mb-4"> I'm delighted to see you interest in this event!</p>
                            <a href="/" class="btn btn-primary">Home</a>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <p>Your Invoice : {{$payment}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
</div>

@endsection