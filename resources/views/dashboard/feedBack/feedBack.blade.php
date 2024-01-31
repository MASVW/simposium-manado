@extends('dashboard.layouts.dash')
@section('feedBack')
<div class="card shadow mb-4">
   <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Feedback Panel</h6>
   </div>
   <div class="card-body">
      <div class="col-lg-12">
         <div class="d-flex justify-content-center">
            <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                        <tr>
                           <th>Name</th>
                           <!-- <th>Email</th> -->
                           <!-- <th>Phone</th> -->
                           <!-- <th>Subject</th> -->
                           <th>Message</th>
                           <th>Action</th>
                           <!-- <th>Date</th> -->
                        </tr>
                  </thead>
                  <tbody>
                     @foreach($feedBack as $item)
                        <tr>
                           <td>{{$item->name}}</td>
                           <!-- <td>{{$item->email}}</td> -->
                           <!-- <td>{{$item->phone}}</td> -->
                           <!-- <td>{{$item->info}}</td> -->
                           <td>{{$item->message}}</td>
                           
                           <td>
                              <div class="d-flex justify-content-center">
                                 <a href="/dashboard/feedBack/detail={{$item->id}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">See Detail</a>
                              </div>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection