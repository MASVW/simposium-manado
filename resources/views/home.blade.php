

@extends('layouts.main')
    @section('main')
        @if($id === null)

        <div
            class="main-banner wow fadeIn"
            id="top"
            data-wow-duration="1s"
            data-wow-delay="0.5s">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 align-self-center">
                                <div
                                    class="left-content show-up header-text wow fadeInLeft"
                                    data-wow-duration="1s"
                                    data-wow-delay="1s">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6>OOPS . . .</h6>
                                            <h2>Saat ini, tidak ada acara yang aktif.</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div
                                    class="right-image wow fadeInRight"
                                    data-wow-duration="1s"
                                    data-wow-delay="0.5s">
                                    <img src="../assets/images/animation/nonData.jpg" alt="Simposi">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @else

        <div
            class="main-banner wow fadeIn"
            id="top"
            data-wow-duration="1s"
            data-wow-delay="0.5s">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 align-self-center">
                                <div
                                    class="left-content show-up header-text wow fadeInLeft"
                                    data-wow-duration="1s"
                                    data-wow-delay="1s">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6>{{ $events->eventDate }}</h6>
                                            <h2>{{ $events->eventName }}</h2>
                                            <?php $teks = $events->excerpt; $maxLength = 450; if (strlen($teks) > $maxLength) {
                                                $teks = substr($teks, 0, $maxLength) . "...";
                                            }?>
                                            <span>{!! $teks !!}</span>
                                        </div>
                                        
                                        <div class="col-lg-12 my-4">
                                            <div class="border-first-button scroll-to-section">
                                                <a href="#desc">Lebih Lanjut!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div
                                    class="right-image wow fadeInRight"
                                    data-wow-duration="1s"
                                    data-wow-delay="0.5s">
                                    @if($events->img)
                                    <img src="{{ asset('./storage/events-images/' . $events->img)}}" alt="Simposi">
                                    @else
                                    <img src="../assets/images/logo/Simposium.png" alt="Simposi">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="desc" class="blog">
            <div class="container">
                <div class="row">
                    <div
                        class="col-lg-4 offset-lg-4  wow fadeInDown"
                        data-wow-duration="1s"
                        data-wow-delay="0.3s">
                        <div class="section-heading">
                            <h6>{{$events->eventDate}}</h6>
                            <h4>Informasi Lebih Lanjut
                                <em>{{$events->eventName}}</em>
                            </h4>
                            <div class="line-dec"></div>
                        </div>
                    </div>
                    <!-- Deskripsi -->
                    <div class="col-lg-7 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                        <div class="blog-post">
                            <div class="thumb">
                                <img src="../assets/images/logo/Simposium.png">
                            </div>
                            <div class="down-content">
                                <span class="category">{{$events->slug}}</span>
                                <span class="date">{{$events->eventDate}}</span>
                                <h4>{{$events->eventName}}</h4>
                                <div class="position-relative mt-2 overflow-auto" style="height: 800px;">
                                    <p>{!! $events->eventDesc !!}</p>
                                </div>
                                @auth
                                <span>
                                    <button type="button" class="btn btn-primary text-body-emphasis mt-5">Register Now!</button>
                                </span>
                                @else
                                <!-- <span>
                                    <button type="button" class="btn btn-primary text-body-emphasis mt-5" disabled>Register Now!</button>
                                </span> -->
                                @endauth
                            </div>
                            <!-- <div class="border-first-button"><a href="#contact">Register Now!</a></div>
                            -->
                        </div>
                    </div>
                    <!-- Harga -->
                    <div class="col-lg-5 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                        <div class="blog-posts">
                            <div class="thumbs">
                                <div class="col-lg-12">
                                    <div class="post-item">
                                        <h4 class="text-center fs-2 fw-bold text-uppercase my-3">Daftar Harga</h4>
                                        
                                        <form action="/tag={{$events->slug}}/price" method="POST" style="align-items: center;">
                                            @CSRF
                                            <select class="form-select form-select-lg mb-3" name="job_id" onchange="this.form.submit()">
                                                <option selected>Selected Position: {{$job->desc}}</option>
                                                @foreach($jobs as $job)
                                                    <option value="{{ $job->id }}">{{ $job->desc }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>

                                        <div class="right-content">
                                            @foreach($price as $event)
                                            <span class="category">{{ $event->priceTag }}</span>
                                            <br>
                                            <div class="container">
                                                <div class="col-lg-12">
                                                    <div class="my-3">
                                                        <div class="d-flex flex-row">
                                                            <div class="p-2 flex-grow-1 align-content-start">
                                                                <h6>{{ $event->priceTag }}</h6>
                                                            </div>
                                                            <div class="p-2 align-content-start">
                                                            Rp
                                                                <span id="harga">
                                                                    {{$event->price}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row">
                                                            <div class="p-2 flex-grow-1 align-content-start">
                                                                {!!$event->priceDesc!!}
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            @auth
                                                            <form action="/addtoBucket/tag={{$event->events->slug}}" method="post">
                                                                @csrf
                                                                <div class="p-2">
                                                                    <input type="hidden" value="{{$event->events->id}}" name="events_id">
                                                                    <input type="hidden" value="{{$event->id}}" name="prices_id">
                                                                    <input type="hidden" value="{{auth()->user()->id}}" name="users_id">
                                                                    <input type="hidden" value="{{$event->position_id}}" name="job_id">
                                                                    <button type="submit" class="btn btn-primary">Tambah ke keranjang</button>
                                                                </div>
                                                            </form>
                                                            @else
                                                            <button type="submit" class="btn btn-primary" id="chart" disabled>Tambah ke keranjang</button>
                                                            @endauth
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="sidebar-divider">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif

@endsection