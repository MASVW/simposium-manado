<?php 
  use App\Models\Events;
  use App\Models\Bucket;?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Simposium Manado">

        <meta name="author" content="Samuel Zakaria">
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"data-client-key="{{config('midtrans.client_key')}}"></script>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <title>Simposium Manado</title>

        <!-- Bootstrap core CSS -->
        <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="/assets/css/fontawesome.css">
        <link rel="stylesheet" href="/assets/css/templatemo-digimedia-v3.css">
        <link rel="stylesheet" href="/assets/css/animated.css">
        <link rel="stylesheet" href="/assets/css/owl.css">        
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


        <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav">
                            <!-- ***** Logo Start ***** -->
                            <a href="/" class="logo">
                                <h5 class="mt-4 pt-2">Simposium Manado</h5>
                            </a>
                            <!-- ***** Logo End ***** -->
                            <!-- ***** Menu Start ***** -->
                            <ul class="nav-sec">
                                <?php $event = Events::where('status', 1)->get();?>
                                @foreach ($event as $event)
                                <li>
                                    <a href="/tag={{$event->slug}}" class="{{($id == $event->id && $title === 'Home') ? 'active' : ''}}">{{$event->eventName}}</a>
                                </li>
                                @endforeach
                                <li> <a href="/about-us" class="{{ ($title === 'AboutUs') ? 'active' : ''}}">Tentang Kami</a> </li>
                                @auth
                                <div class="btn-group">
                                <li>
                                    <a>Hi! {{ auth()->user()->firstName}}</a>
                                </li>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false"></button>
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
                                    <li>
                                        <a href="{{ route('login') }}" class="{{ ($title === 'Login') ? 'active' : ''}}">Masuk</a>
                                    </li>
                                    <li>
                                        <div class="border-first-button">
                                            <a href="{{route('register')}}" class="{{ ($title === 'SignUp') ? 'active' : ''}}">Daftar Sekarang!</a>
                                        </div>
                                    </li>
                                @endauth
                            </ul>
                            <ul class="nav">
                            <?php $event = Events::where('status', 1)->get();?>
                                @auth
                                @foreach ($event as $event)
                                <li>
                                    <a href="/tag={{$event->slug}}" class="{{($id == $event->id && $title === 'Home') ? 'active' : ''}}">{{$event->eventName}}</a>
                                </li>
                                @endforeach
                                <li> <a href="/about-us" class="{{ ($title === 'AboutUs') ? 'active' : ''}}">Tentang Kami</a> </li>                               
                                <li>
                                    <a href="/profile" class="m-0 p-0"><button class="dropdown-item m-0 ps-3 py-0" type="button"><i class="bi bi-person-fill me-2"></i></i>Profile</button></a>
                                </li>
                                <li>
                                    <a  class="dropdown-item m-0 ps-3" data-bs-toggle="modal" data-bs-target="#bucket">
                                    <i class="bi bi-basket me-2"></i>Cart</a>
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
                                
                                <li>
                                    <a>
                                        <form action="/logout" method="post">
                                        @csrf
                                            <button class="dropdown-item" type="submit">
                                                <i class="bi bi-box-arrow-right me-2"></i>Log Out
                                            </button>
                                        </form>
                                    </a>
                                </li>
                                <li>

                                </li>
                                @else
                                @foreach ($event as $event)
                                <li>
                                    <a href="/tag={{$event->slug}}" class="{{($id == $event->id && $title === 'Home') ? 'active' : ''}}">{{$event->eventName}}</a>
                                </li>
                                @endforeach
                                <li> <a href="/about-us" class="{{ ($title === 'AboutUs') ? 'active' : ''}}">Tentang Kami</a> </li>
                                <li>
                                    <a href="{{ route('login') }}" class="{{ ($title === 'Login') ? 'active' : ''}}">Masuk</a>
                                </li>
                                <li>
                                    <a href="{{route('register')}}" class="{{ ($title === 'SignUp') ? 'active' : ''}}">Daftar Sekarang!</a>
                                </li>
                                <li>
                                    
                                </li>
                                @endauth
                            </ul>
                            <a class='menu-trigger'>
                                <span>Menu</span>
                            </a>
                        <!-- ***** Menu End ***** -->
                        </nav>
                </div>
            </div>
        </header>
        <!-- ***** Preloader End ***** -->

        
        @yield('main') @yield('check-out') @yield('aboutUs') @yield('login')
        @yield('signUp') @yield('payment') @yield('invoice') @yield('profile')
        @yield('editProfile') @yield('form') @yield('history')@yield('forgot-password')
        

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

        <div class="floating-button">
    <button class="btn btn-primary" type="button" style="border-radius: 100%; padding-left: 13px; padding-right: 13px"
        data-bs-toggle="modal"
        data-bs-target="#bucket">
        <h3 class="my-1">
            <i class="bi bi-basket" style="color: white;"></i>
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
                        
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Keranjangmu</h1>
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
                            <p>Pilih Item</p>
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
                                                <button type="submit" class="btn btn-primary">Proses</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
        // Pengecekan elemen excerptText
        var excerptElement = document.getElementById("excerptText");
        if (excerptElement) {
            var maxLength = 500;
            var excerptHTML = excerptElement.innerHTML;

            if (excerptHTML.length > maxLength) {
                var limitedHTML = excerptHTML.substring(0, maxLength);
                var lastHTMLIndex = limitedHTML.lastIndexOf('<');
                var limitedText = excerptHTML.substring(0, lastHTMLIndex);
                excerptElement.innerHTML = limitedText + " ...";
            }
        }

        // Pengecekan elemen harga
        var valueElement = document.getElementById('harga');
        if (valueElement) {
            var originalValue = parseFloat(valueElement.innerHTML);
            var formattedValue = originalValue.toLocaleString('id-ID', { minimumFractionDigits: 2 });
            valueElement.innerHTML = formattedValue;
        }
    });
</script>
    </body>
</html>