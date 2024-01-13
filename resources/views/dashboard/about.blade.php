@extends('dashboard.layouts.dash')
@section('about')
<div class="row"> 
                <div class="col-lg-12">
                    <div class="col-lg-6 mx-auto">
                    <div class="p-5">
                        @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="text-center">
                            <h1 class="h4 mb-4 font-weight-bold" style="color: #4e73df;">Manage Information</h1>
                            <hr></div>
                            <form
                                action="/dashboard/manage-about"
                                method="post"
                                class="user" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    </div>
                                        <p>Title</p>
                                        <div class="input-group">
                                            <textarea
                                                name="infoName"
                                                id="infoName"
                                                class="@error('infoName') is-invalid @enderror"
                                                aria-label="With textarea" style="width: auto; height: auto"
                                                rows="5">{{old('infoName', $info->infoName)}}</textarea>
                                            @error('infoName')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <script>
                                                ClassicEditor
                                                    .create(document.querySelector( '#infoName'))
                                                    .catch(error=> { 
                                                        console.error(error);
                                                    });
                                            </script>
                                        </div>
                                        <p class="mt-3">Information</p>
                                        <div class="input-group">
                                            <textarea
                                                name="info"
                                                id="info"
                                                class="form-contro)l mb-4 @error('info') is-invalid @enderror"
                                                aria-label="With textarea"
                                                rows="20">{{old('info', $info->info)}}</textarea>
                                            @error('info')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <script>
                                                ClassicEditor
                                                    .create( document.querySelector( '#info' ) )
                                                    .catch( error => {
                                                        console.error( error );
                                                    } );
                                            </script>
                                        </div>
                                            <input type="hidden" name="id" value="{{$info->id}}">
                                            <button type="submit" class="btn btn-primary btn-user btn-block mt-4">Save</button>
                                        </form>
                </div>
            </div>
@endsection