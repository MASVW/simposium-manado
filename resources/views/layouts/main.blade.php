<?php 
  use App\Models\Events;
  use App\Models\Bucket;
  $event = Events::where('status', 1)->get();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">

        <meta name="author" content="">
        <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{config('midtrans.client_key')}}"></script>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin="crossorigin">
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">

        <title>Simposium Manado</title>

        <!-- Bootstrap core CSS -->
        <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="/assets/css/fontawesome.css">
        <link rel="stylesheet" href="/assets/css/templatemo-digimedia-v3.css">
        <link rel="stylesheet" href="/assets/css/animated.css">
        <link rel="stylesheet" href="/assets/css/owl.css">
        <!-- TemplateMo 568 DigiMedia https://templatemo.com/tm-568-digimedia -->
        
    </head>

    <body>
        <!-- ***** Preloader Start ***** -->
        <div id="js-preloader" class="js-preloader">
            <div class="preloader-inner">
                <span class="dot"></span>
                <div class="dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

        <header
            class="header-area header-sticky wow slideInDown"
            data-wow-duration="0.75s"
            data-wow-delay="0s">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav">
                            <!-- ***** Logo Start ***** -->
                            <a href="/" class="logo">
                                <h3 class="mt-4 pt-2">Simposium Manado</h3>
                                <!-- kalau ada image -->
                                <!-- <img src="assets/images/logo-v3.png" alt=""> -->
                            </a>
                            <!-- ***** Logo End ***** -->
                            <!-- ***** Menu Start ***** -->
                            <ul class="nav">
                                @foreach ($event as $event)
                                <li class="scroll-to-section">
                                    <a
                                        href="/tag={{$event->slug}}"
                                        class="{{($id == $event->id && $title === 'Home') ? 'active' : ''}}">{{$event->eventName}}</a>
                                </li>
                                @endforeach
                                <li class="scroll-to-section">
                                    <a href="/about-us" class="{{ ($title === 'AboutUs') ? 'active' : ''}}">About Us</a>
                                </li>
                                @auth
                                <div class="btn-group">
                                    <li class="mt-1">
                                        <p class="mt-0 pt-0 text-body fw-bolder">Hi!
                                            {{ auth()->user()->firstName}}</p>
                                    </li>
                                    <button
                                        type="button"
                                        class="btn btn-primary dropdown-toggle"
                                        data-bs-toggle="dropdown"
                                        data-bs-display="static"
                                        aria-expanded="false"></button>
                                    <ul class="dropdown-menu">

                                    <li>
                                        <a href="/profile" class="m-0 p-0"><button class="dropdown-item m-0 ps-3 py-0" type="button"><i class="bi bi-person-fill me-2"></i></i>Profile</button></a>
                                    </li>
                                    <li>
                                        <button  class="dropdown-item m-0 ps-3" type="button"data-bs-toggle="modal" data-bs-target="#bucket">
                                            <i class="bi bi-basket me-2"></i>Cart</button>
                                    </li>
                                    <li>
                                        <a href="/history" class="m-0 p-0"><button class="dropdown-item m-0 ps-3 py-0" type="button"><i class="bi bi-clock-history me-2"></i></i>History</button></a>
                                    </li>
                                    <li>
                                        <a href="/profile/edit/pass" class="m-0 p-0"><button class="dropdown-item m-0 ps-3 py-0" type="button"><i class="bi bi-shield-lock-fill me-2"></i></i>Change Password</button></a>
                                    </li>
                                    @can('admin')
                                    <li>
                                        <a href="/dashboard" class="m-0 p-0"><button class="dropdown-item m-0 ps-3 py-0" type="button">
                                        <i class="bi bi-speedometer2 me-2"></i></i>Dashboard</button>
                                        </a>
                                    </li>
                                    @endcan
                                    <li><hr class="dropdown-divider"></li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <li>
                                            <button class="dropdown-item" type="submit">
                                                <i class="bi bi-box-arrow-right me-2"></i>Log Out</button>
                                        </li>
                                        <li></li>
                                    </form>
                                </ul>
                            </div>
                            @else
                            <li class="scroll-to-section">
                                <a href="/login" class="{{ ($title === 'Login') ? 'active' : ''}}">Login</a>
                            </li>
                            <li class="scroll-to-section">
                                <div class="border-first-button">
                                    <a href="/signup" class="{{ ($title === 'SignUp') ? 'active' : ''}}">Sign Up Now!</a>
                                </div>
                            </li>
                            @endauth

                        </ul>
                        <!-- ***** Menu End ***** -->
                    </div>
                </div>
            </div>
        </header>
        <!-- ***** Preloader End ***** -->

        
        @yield('main') @yield('check-out') @yield('aboutUs') @yield('login')
        @yield('signUp') @yield('payment') @yield('invoice') @yield('profile')
        @yield('editProfile') @yield('form') @yield('history')
        

        <!-- Button trigger modal -->
        <!-- Chart -->
        <!-- <div class="d-flex"> <button type="button" class="btn btn-primary"
        style="float: right" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Launch static backdrop modal </button> </div> -->
        
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p>Simposium Manado</p>
                    </div>
                </div>
            </div>
        </footer>
        @auth

        <div class="fixed-bottom m-3" style="position: fixed; left: 92%; bottom:20px">
            <button
                class="btn btn-primary "
                type="button"
                style="border-radius: 100%; padding-left: 13px; padding-right: 13px"
                data-bs-toggle="modal"
                data-bs-target="#bucket">
                <h3 class="my-1">
                    <i class="bi bi-basket"></i>
                </h3>
            </button>
        </div>

        <div
            class="modal fade"
            id="bucket"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Your Bucket</h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="col-lg-12">
                            <p>Select Items</p>
                            <?php 
                                $data = Bucket::with(['events', 'users', 'prices'])
                                ->where('users_id', auth()->user()->id)
                                ->whereNull('payments_id')
                                ->get();
                                $remove = Bucket::with(['events', 'users', 'prices'])
                                ->where('users_id', auth()->user()->id)
                                ->whereNull('payments_id')
                                ->get();
                            ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <form action="/checkout">
                                            @foreach($data as $data)
                                            <div class="row align-items-center" style="height: 150px;">
                                                <div class="col-lg-1">
                                                    <div class="">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            id="inlineCheckbox1"
                                                            value="{{$data->id}}"
                                                            name="data[]">
                                                    </div>
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="lg-12">
                                                        <h5>{{$data->events?->eventName}}</h5>
                                                        <p class="mt-2" style="font-weight: 600;">{{$data->prices?->priceTag}}</p>
                                                        <?php
                                                            $teks = $data->prices?->priceDesc;
                                                            $maxLength = 100;

                                                            if (strlen($teks) > $maxLength) {
                                                                $teks = substr($teks, 0, $maxLength) . " ...";
                                                            }
                                                        ?>
                                                        <p style="font-weight: 400;">{!!$teks!!}</p>
                                                        <p style="font-weight: 400;">Harga : IDR {{ number_format($data->prices?->price, 2, ',', '.')}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Check Out</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        @foreach($remove as $data)
                                            <form action="/bucket/delete" method='post'>
                                            @csrf
                                                <div class="row" style="height: 150px;">
                                                    <button class="y-0 m-0 btn btn-link" style=" border: none" value="{{$data->id}}" name="id">
                                                        <h5>
                                                            <i class="bi bi-dash-circle"></i>
                                                        </h5>
                                                    </button>
                                                </div>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        @endauth
        <!-- Scripts -->
        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/owl-carousel.js"></script>
        <script src="/assets/js/animation.js"></script>
        <script src="/assets/js/imagesloaded.js"></script>
        <script src="/assets/js/custom.js"></script>
        <script>
document.addEventListener("DOMContentLoaded", function() {
    var maxLength = 500;
    var excerptElement = document.getElementById("excerptText");
    var excerptHTML = excerptElement.innerHTML;

    if (excerptHTML.length > maxLength) {
        // Menemukan batas panjang untuk teks tanpa menghancurkan elemen HTML
        var limitedHTML = excerptHTML.substring(0, maxLength);

        // Mencari tempat terakhir elemen HTML
        var lastHTMLIndex = limitedHTML.lastIndexOf('<');

        // Mengambil potongan teks sejauh batas panjang tanpa memotong elemen HTML
        var limitedText = excerptHTML.substring(0, lastHTMLIndex);

        // Menetapkan teks yang telah dipotong dan ditambahkan "..."
        excerptElement.innerHTML = limitedText + " ...";
    }
});
</script>
    </body>
</html>