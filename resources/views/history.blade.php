@extends('layouts.main')

@section('history')

<?php 
use App\Models\Bucket;
use App\Models\Prices;

$item = Bucket::where('users_id', 1)
    ->with('prices', 'events', 'payments', "datas")
    ->whereHas('payments', function ($query) {
        $query->where('status', '=', 'Paid');
    })
    ->get();
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
                
                <div class="col-lg-12">
                    <div class="row">
                    
                            <div class="col-lg-10">
                                <br>
                                <h4>Success History Payment</h4>
                            </div>
                            <div class="col-lg-2">
                            </div>
                        
                    </div>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                    <th scope="col">Payment ID</th>
                                    <th scope="col">Event Name</th>
                                    <th scope="col">Event Date</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                            </tr>
                        </thead>
                        <?php $i=0; $printed = array();?>
                        @foreach($item as $items)
                        <?php $i++?>
                        <tbody>
                            <tr>
                                <th scope="row">{{$items->payments->id}}</th>
                                <td>{{$items->events->eventName}}</td>
                                <td>{{$items->events->eventDate}}</td>
                                <?php $price = number_format($items->prices->price, 2, ',', '.'); ?>
                                <td>{{ $price }}</td>
                                <td>{{$items->payments->status}}</td>
                                <td>
                                        @if($items->datas && $items->datas->isFilled == null)
                                            @if(!isset($printed[$items->payments->id]))
                                                <?php $printed[$items->payments->id] = true; ?> 
                                                <form action="/{{$items->payments_id}}/fillForm" method="get">
                                                @csrf
                                                    <li>
                                                        <button class="btn btn-primary" type="submit">
                                                            <i class="bi bi-box-arrow-right me-2"></i>Fill Form
                                                        </button>
                                                    </li>
                                                </form>
                                            
                                            @endif
                                        @elseif($items->datas && $items->datas->isFilled == 1)
                                            @if(!isset($printed[$items->payments->id]))
                                                <?php $printed[$items->payments->id] = false; ?> 
                                                    <form action="/{{$items->payments_id}}/fillForm" method="get">
                                                    @csrf
                                                    <li>
                                                        <button class="btn btn-primary" type="submit" disabled>
                                                            <i class="bi bi-box-arrow-right me-2"></i>Fill Form
                                                        </button>
                                                    </li>
                                                </form>
                                            
                                            @endif
                                        @endif
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
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
                                    <form action="/checkout/payment/{{$unsuccess->payments->id}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-link">
                                            {{$unsuccess->payments->id}}
                                        </button>
                                    </form>
                                </th>
                                <td>{{$unsuccess->events->eventName}}</td>
                                <td>{{$unsuccess->events->eventDate}}</td>
                                <td>{!!$unsuccess->prices->priceDesc!!}</td>
                                <?php $priceUnsuccess = number_format($unsuccess->prices->price, 2, ',', '.'); ?>
                                <td>{{$priceUnsuccess}}</td>
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