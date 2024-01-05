@extends('dashboard.layouts.dash')

    

@section('view-event')
<?php 
    use App\Models\Payment;
    use App\Models\Bucket;
    use App\Models\Events;
    use App\Models\Prices;

    $event1 = Events::find(1);
    $event2 = Events::find(1);

    $totalPaid = Bucket::whereHas('payments', function ($query) {
        $query->where('status', 'Paid');
    })->whereHas('events', function ($query) use ($event1) {
        $query->where('eventName', $event1->eventName);
    })->count();
    $totalUnpaid = Bucket::whereHas('payments', function ($query) {
        $query->where('status', 'Paid');
    })->whereHas('events', function ($query) use ($event1) {
        $query->where('eventName', $event1->eventName);
    })->count();
    
    $totalPaid2 = Bucket::whereHas('payments', function ($query) {
        $query->where('status', 'Paid');
    })->whereHas('events', function ($query) use ($event2) {
        $query->where('eventName', $event2->eventName);
    })->count();
    $totalUnpaid2 = Bucket::whereHas('payments', function ($query) {
        $query->where('status', 'Paid');
    })->whereHas('events', function ($query) use ($event2) {
        $query->where('eventName', $event2->eventName);
    })->count();
    
    


    $unsuccessPaymentCount= Bucket::whereHas('payments', function ($query) {
        $query->where('status', 'Unpaid');
    })->latest()->count();

    $showUserpaid = Bucket::whereNotNull('payments_id')->with('users', 'payments')->latest()->get()
    // dd($showUserpaid);
?>
<div class="row">
    <div class="container-fluid">
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <p>{{$event1->eventName}}</p></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Participants :  {{$totalPaid}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-smile fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                {{$event1->eventName}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalUnpaid}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-frown fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{$event2->eventName}}
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$totalUnpaid2}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-smile fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                {{$event2->eventName}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalUnpaid2}}</div>
                            </div>
                            <div class="col-auto">
                            <i class="far fa-frown fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@foreach ($data as $event)
    <div class="col-lg-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            
            <div class="card-header py-3">
                <a href=""><h6 class="m-0 font-weight-bold text-primary">{{ $event->eventName }}</h6></a>
            </div>
            <div class="card-body">
                <p class="fs-1 text-primary fw-bold">Excerpt:</p>
                <div class="position-relative mt-2 overflow-auto" style="height: 300px;">
                    <p>{!!$event->excerpt!!}</p>
                </div>
                <hr class="sidebar-divider">
                <p class="fs-1 text-primary fw-bold">Slug: <em>{{$event->slug}}</em></p>
                <hr class="sidebar-divider">
                <p class="fs-1 text-primary fw-bold">Description:</p>
                <div class="position-relative mt-2 overflow-auto" style="height: 300px;">
                    <p>{!!$event->eventDesc!!}</p>
                </div>


                
                <hr class="sidebar-divider">
                <h6 class="ms-5 font-weight-bold text-primary">Price List</h6>
            
                <div class="position-relative mt-2 overflow-auto" style="height: 350px;">
                @foreach (Prices::where('events_id', $event['id'])->with('events')->get() as $data2)
                    <span class="category">{{ $data2->priceTag }}</span>
                    <br>
                    <div class="container">
                        <div class ="col-lg-12">
                        <div class="my-3">
                            <div class="d-flex flex-row">
                                <div class="p-2 flex-grow-1 align-content-start">
                                <h6>{{ $data2->priceTag }}</h6>
                                </div>
                                <div class="p-2 align-content-start">
                                <span>
                                    Rp {{$data2->price}}
                                </span>
                                </div>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="p-2 flex-grow-1 align-content-start">
                                {!!$data2->priceDesc!!}
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <hr class="sidebar-divider">
            @endforeach    
                </div>
            
            </div>
            <hr class="sidebar-divider">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-pmrimary">{{ $event->eventDate }}</h6>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection