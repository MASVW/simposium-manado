@extends('layouts.main') @section('aboutUs')
<div id="about" class="about section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div
                            class="about-left-image  wow fadeInLeft"
                            data-wow-duration="1s"
                            data-wow-delay="0.5s">
                            <img src="assets/images/animation/about-us.svg" alt="">
                        </div>
                    </div>
                    <div
                        class="col-lg-6 align-self-center  wow fadeInRight"
                        data-wow-duration="1s"
                        data-wow-delay="0.5s">
                        <div class="about-right-content">
                            <div class="section-heading">
                                <h6>About Us</h6>
                                <h4>{{$info->infoName}}</h4>
                                <div class="line-dec"></div>
                            </div>
                            <p>{{$info->info}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection