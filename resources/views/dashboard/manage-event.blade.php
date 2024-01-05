@extends('dashboard.layouts.dash')
@section('manage-event')
    <div class="row">
        @foreach ($event as $event)
        <a href="">
            <div class="col-lg-6">
                @if($event->img)
                @endif
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex">
                        <div class="col-lg-10">
                            @if($event->status  == 1)
                                <a href="/dashboard/manage-event/tag={{$event->slug}}"><h6 class="m-0 font-weight-bold" style="color: #4e73df;">{{ $event->eventName }}</h6></a>
                            @else    
                                <a href="/dashboard/manage-event/tag={{$event->slug}}"><h6 class="m-0 font-weight-bold" style="color: #e74a3b;">{{ $event->eventName }}</h6></a>
                            @endif
                        </div>
                        <div class="col-lg-2">
                            @if($event->status  == 1)
                                <h6 class="m-0 font-weight-bold" style="color: #4e73df;">Active</h6>
                            @else    
                                <h6 class="m-0 font-weight-bold" style="color: #e74a3b;">Non-Active</h6>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                            <div class="col-lg-12">
                                <img src="{{ asset('/storage/events-images/' . $event->img)}}" alt="" height="350px" width="auto">
                            </div>
                            <h6 class="mt-3 mb-2 font-weight-bold text-pmrimary">{{ $event->eventDate }}</h6>
                            <p class="fs-1 text-primary fw-bold">Excerpt:</p>

                            <div class="position-relative mt-2 overflow-auto" style="height: 300px;">
                                <p>{!! $event->excerpt !!} </p>
                            </div>
                            
                            <br><br>
                            <p class="fs-1 text-primary fw-bold">Slug: <em>{{$event->slug}}</em></p>    
                        </div>
                        <div class="card-header py-3 d-flex flex-row-reverse">
                            <a href="/dashboard/manage-event/tag={{$event->slug}}" class="mt-2">
                            <i class="bi bi-pencil-square m-2"></i>
                            </a>
                            </a>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
    </div>
@endsection