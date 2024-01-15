@extends('layouts.main')

@section('profile')

<?php 
use App\Models\Bucket;
$unsuccess = Bucket::where('users_id', auth()->user()->id)
    ->with('prices', 'events', 'payments')
    ->whereHas('payments', function ($query) {
        $query->where('status', '=', 'Unpaid');
    })
    ->get();
?>
<div
    class="main-banner wow fadeIn"
    id="top"
    data-wow-duration="1s"
    data-wow-delay="0.5s">
    <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <h2>Hi! {{auth()->user()->firstName}} {{auth()->user()->lastName}}</h2>
                </div>
                <div class="col-lg-2">
                    <form action="/profile/edit" method="get">
                        @csrf
                        <li>
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-box-arrow-right me-2"></i>Edit Profile
                            </button>
                        </li>
                    </form>
                </div>
            </div>
                <hr class="mt-3">
                <div class="col-lg-12">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th scope="row">Nama: </th>
                                <td colspan="3">{{auth()->user()->firstName}} {{auth()->user()->lastName}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email :</th>
                                <td colspan="3">{{auth()->user()->email}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Birt Date:</th>
                                <td colspan="1">{{auth()->user()->birthDate}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="col-lg-12">
                        <br>
                    <h4>Unsuccess History Payment</h4>
                    </div>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                            <th scope="col">Payment ID</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Event Date</th>
                            <th scope="col">Price Tag</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <?php $i=0;?>
                        @foreach($unsuccess as $unsuccess)
                        <?php $i++?>
                        <tbody>
                            <tr>
                                <th scope="row">
                                        <u style="color: blue;"><a href="/{{$unsuccess->payments->id}}/fillForm" style="color: blue">
                                            {{$unsuccess->payments->id}}
                                        </a></u>
                                </th>
                                <td>{{$unsuccess->events->eventName}}</td>
                                <td>{{$unsuccess->events->eventDate}}</td>
                                <td>{{$unsuccess->prices->priceDesc}}</td>
                                <td>{{$unsuccess->prices->price}}</td>
                                <td>{{$unsuccess->payments->status}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection