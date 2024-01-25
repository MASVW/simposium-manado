@extends('dashboard.layouts.dash')
   @section('detailsFeedback')
      <div class="container">
         <div class="d-flex justify-content-center">
            <div class="col-lg-10">
               <div class="card shadow mb-4">
                  <div class="card-header py-3" > 
                     <div class="row">
                        <div class="col-lg-8" id="head">
                           <label for="head">Feedback from {{$feedBack->name}}</label>
                        </div>
                        <div class="col-lg-4" id="date">
                           <?php $timestamp = $feedBack->created_at; $newFormat = date('H:i, j F Y', strtotime($timestamp));?>
                           <label for="date"> Created at {{$newFormat}}</label>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5>{{$feedBack->info}}</h5>
                     <p>{{$feedBack->message}}</p>
                     <br>
                     <br>
                     <h5>Contact</h5>
                     <p><i class="far fa-envelope"></i> {{$feedBack->email}}</p>
                     <p><i class="far fa-envelope"></i> {{$feedBack->phone}}</p>
                  </div>
                  <div class="card-footer">
                     @if(!$feedBack->users_id)
                        <div style="text-align: right;">
                           <label for="">Users not registered</label>
                        </div>
                     @else
                        <div style="text-align: right;">
                           <label for="">Users allready registered</label>
                        </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   @endsection