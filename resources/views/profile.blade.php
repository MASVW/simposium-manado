@extends('layouts.main')

@section('profile')

<?php 
use App\Models\Bucket;
$unsuccess = Bucket::where('users_id', auth()->user()->id)
    ->with('prices.positions', 'events', 'payments')
    ->whereHas('payments', function ($query) {
        $query->where('status', '=', 'Unpaid');
    })
    ->get();
?>

<div id="contact" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                
                    <form id="contact">
                        @csrf
                        <div class="col-lg-12">
                            <div class="fill-form">
                                <div class="row">
                                    <h3 class="text-center my-4">Hi {{auth()->user()->firstName}} {{auth()->user()->lastName}}!</h3>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-center">
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <p class="text-start text-dark">Nama : {{auth()->user()->firstName}} {{auth()->user()->lastName}}</p>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-center">
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <p class="text-start text-dark">Email : {{auth()->user()->email}}</p>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-center">
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <p class="text-start text-dark">Birth Date : {{auth()->user()->birthDate}}</p>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-center">
                                            <div class="col-lg-6">
                                                <div class="custom-button">
                                                    <a href="/profile/edit" class="btn btn-outline-primary"><i class="bi bi-box-arrow-right me-2"></i>Perbarui Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center my-3">
                                        <div class="col-lg-8">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-5 table-responsive">
                                    <div class="col-lg-12">
                                        <br>
                                        <h4>Pembayaran Belum Selesai</h4>
                                    </div>
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                            <th scope="col">Nomor Payment</th>
                                            <th scope="col">Nama Acara</th>
                                            <th scope="col">Tanggal Kegiatan</th>
                                            <th scope="col">Posisi</th>
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
                                                <td>{{$unsuccess->prices->positions->desc}}</td>
                                                <td>{{$unsuccess->payments->total}}</td>
                                                <td>{{$unsuccess->payments->status}}</td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
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