@extends('dashboard.layouts.dash') @section('main')
<?php 
    use App\Models\Payment;
    use App\Models\Bucket;
    $totalPayment = Payment::sum("total");
    $successPayment= Payment::where('status', 'Paid')->sum("total");
    $successPaymentCount= Bucket::whereHas('payments', function ($query) {
        $query->where('status', 'paid');
    })->latest()->count();

    $unsuccessPaymentCount= Bucket::whereHas('payments', function ($query) {
        $query->where('status', 'Unpaid');
    })->latest()->count();

    $showUserpaid = Bucket::whereNotNull('payments_id')->with('users', 'payments')->latest()->get()
    // dd($showUserpaid);
?>
<div id="content">

    <!-- Topbar -->

    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <p>Earnings (Include Pending)</p></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">IDR {{ number_format($totalPayment, 2, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Success Payments</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">IDR {{ number_format($successPayment, 2, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Success Payment Total
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $successPaymentCount}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Unsuccess Payment</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$unsuccessPaymentCount}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
                        <div class="dropdown no-arrow"></div>
                    </div>
                    <!-- Card Body -->
                    <div class="position-relative mt-2 overflow-auto" style="height: 400px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <?php $i=1 ?>
                        @foreach($showUserpaid as $item)
                                <tbody>
                                    <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$item->users->firstName}}</td>
                                    <td>{{$item->users->email}}</td>
                                    <td>{{$item->events->eventName}}</td>
                                    <td>{{$item->payments?->status}}</td>
                                    </tr>
                                </tbody>
                                <?php $i++; ?>
                            @endforeach
                                </table>
                    </div>
                    
                    
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Active Events</h6>
                        <div class="dropdown no-arrow"></div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @foreach ($event as $event)
                        <h3>{{$event->eventName}}</h3>
                        <p>
                            <em></em>{{$event->eventDate}}</p>
                        @endforeach
                    </div>
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">All Events</h6>
                        <div class="dropdown no-arrow"></div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @foreach ($allEvent as $event)
                        <h3>{{$event->eventName}}</h3>
                        <p>
                            <em></em>{{$event->eventDate}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection