@extends('layouts.main')

@section('history')

<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s"data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div id="contacts" class="">
                    <div class="table-responsive">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="d-flex justify-content-center mb-3">
                                    <div class="col-lg-12">
                                        <br>
                                        <h4>Success History Payment</h4>
                                    </div>
                                </div>
                            </div>
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Pembayaran</th>
                                        <th scope="col">Nama Acara</th>
                                        <th scope="col">Tanggal Kegiatan</th>
                                        <th scope="col">Posisi</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Form</th>
                                    </tr>
                                </thead>
                                <?php $i=0; $printed = array();?>
                                @foreach($item as $items)
                                <tbody>
                                    <tr>
                                        <th scope="row">{{$items->payments->id}}</th>
                                        <td>{{$items->events->eventName}}</td>
                                        <td>{{$items->events->eventDate}}</td>
                                        <td>{{$items->prices->positions->desc}}</td>
                                        <?php $price = number_format($items->prices->price, 2, ',', '.'); ?>
                                        <td>{{ $price }}</td>
                                        
                                        <td><a href="/{{$items->payments->id}}/viewForm" class="btn btn-primary">View Form</a></td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="mt-5">
                        <hr>
                    </div>
                    <div class="table-responsive my-5">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-center mb-3">
                                <div class="col-lg-12">
                                    <br>
                                    <h4>Unsuccess History Payment</h4>
                                </div>
                            </div>
                            <table class="table mt-3 mb-5">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Pembayaran</th>
                                        <th scope="col">Nama Acara</th>
                                        <th scope="col">Tanggal Kegiatan</th>
                                        <th scope="col">Posisi</th>
                                        <th scope="col">Total</th>
                                        <!-- <th scope="col" style="opacity: 0;">View Form</th> -->
                                    </tr>
                                </thead>
                                <?php $i=0;?>
                                @foreach($unsuccess as $unsuccess)
                                <?php $i++?>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <form action="/checkout/payment/{{$unsuccess->payments->id}}" method="post">
                                                @csrf
                                                <button type="submit" class="link-like-button my-0 py-2">
                                                    {{$unsuccess->payments->id}}
                                                </button>
                                            </form>
                                        </th>
                                        <td>{{$unsuccess->events->eventName}}</td>
                                        <td>{{$unsuccess->events->eventDate}}</td>
                                        <td>{{$unsuccess->prices->positions->desc}}</td>
                                        <?php $priceUnsuccess = number_format($unsuccess->prices->price, 2, ',', '.'); ?>
                                        <td>{{$priceUnsuccess}}</td>
                                        <!-- <td style="opacity: 0;">Form</td> -->
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
</div>
@endsection