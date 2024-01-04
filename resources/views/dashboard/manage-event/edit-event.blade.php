@extends('dashboard.layouts.dash')
@section('main') 
<div class="row"> 
    <div class="col-lg-6">
    <div class="p-5">
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">{{$events->eventName}}</h1>
            <hr></div>
            <form
                action="/dashboard/manage-event/tag={{$events->id}}"
                method="post"
                class="user" enctype="multipart/form-data">
                @method('put') @csrf
                <div class="form-group">
                    <div class="mb-3">
                        <label for="formFile" class="form-label @error('img') is-invalid @enderror">Upload  Image</label>
                        <input class="form-control-user ps-5" type="file" name="img">
                        @error('img')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>
                    <p>Title</p>
                    <input
                        type="text"
                        class="form-control form-control-user @error('eventName') is-invalid @enderror"
                        value="{{old('eventName', $events->eventName)}}"
                        name="eventName"
                        id="eventName"
                        aria-describedby="emailHelp">
                        @error('eventName')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <p>Slug</p>
                        <input
                            type="text"
                            class="form-control form-control-user @error('slug') is-invalid @enderror"
                            value="{{old('slug', $events->slug)}}"
                            name='slug'
                            id="slug"
                            readonly="readonly">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <p>Excerpt</p>
                        <div class="input-group">
                            <textarea
                                name="excerpt"
                                class="form-control mb-4 @error('excerpt') is-invalid @enderror"
                                aria-label="With textarea"
                                rows="5">{{old('excerpt', $events->excerpt)}}</textarea>
                            @error('excerpt')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <p>Description</p>
                        <div class="input-group">
                            <textarea
                                name="eventDesc"
                                class="form-control mb-4 @error('eventDesc') is-invalid @enderror"
                                aria-label="With textarea"
                                rows="20">{{ old('eventDesc',$events->eventDesc)}}</textarea>
                            @error('eventDesc')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <p>Date</p>
                        <input
                            value="{{ old('eventDate', $events->eventDate)}}"
                            class="form-control mb-4 @error('eventDate') is-invalid @enderror my-0"
                            type="date"
                            name="eventDate"
                            required="true">
                            @error('eventDate')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                            <button type="submit" class="btn btn-primary btn-user btn-block mb-4">Save</button>
                        </form>
                        <form
                            action="/dashboard/manage-event/tag={{$events->slug}}/Addprice"
                            method="post"
                            class="user">
                            @csrf
                            <button
                                type="submit"
                                class="btn btn-secondary btn-user btn-block"
                                onclick="return confirm('Confirm Adding New Price')">Add Price</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        @foreach($price as $priceItem)
                        <form
                            action="/dashboard/manage-event/tag={{$events->slug}}/pricePut"
                            method="post"
                            class="user">
                            @method('put') @csrf
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{$priceItem->priceTag}}</h1>
                                    <hr></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p>Price Tag</p>
                                            <input
                                                type="text"
                                                class="form-control form-control-user @error('priceTag') is-invalid @enderror"
                                                value="{{old('priceTag', $priceItem->priceTag)}}"
                                                id="priceTag"
                                                aria-describedby="emailHelp"
                                                name="priceTag">
                                                @error('priceTag')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                                <p>Price</p>
                                                <div class="input-group">
                                                    <input
                                                        style="margin-left: 10px;"
                                                        type="text"
                                                        class="form-control form-control-user @error('price') is-invalid @enderror"
                                                        value="{{ old('price', isset($priceItem) ? number_format($priceItem->price, 0, ',', '.') : '') }}"
                                                        id="price{{$priceItem->id}}"
                                                        aria-describedby="emailHelp"
                                                        name="price">
                                                    @error('price')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <script>
                                                    function unformatNumber(formattedNumber) {
                                                        return formattedNumber.replace(/\./g, '');
                                                    }

                                                    document.getElementById('price{{$priceItem->id}}').addEventListener('input', function() {
                                                        var inputValue = this.value;

                                                        var unformattedValue = unformatNumber(inputValue);

                                                        this.value = Number(unformattedValue).toLocaleString('id-ID');
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <p>Description</p>
                                            <textarea
                                                id="editor{{$priceItem->id}}"
                                                class="form-control mb-1 @error('priceDesc') is-invalid @enderror"
                                                aria-label="With textarea"
                                                rows="5"
                                                name="priceDesc">{{old('priceDesc', $priceItem->priceDesc)}}</textarea>
                                            @error('priceDesc')                                            
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <script>
                                                ClassicEditor
                                                    .create( document.querySelector( '#editor{{$priceItem->id}}' ) )
                                                    .catch( error => {
                                                        console.error( error );
                                                    } );
                                            </script>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="hidden" name="id" value="{{$priceItem->id}}">
                                                    <button type="submit" class="btn btn-primary btn-user btn-block mb-4">Save</button>
                                                </form>
                                            </div>
                                            <div class="col-lg-6">
                                                <form
                                                    action="/dashboard/manage-event/tag={{$events->slug}}/priceDelete"
                                                    method="post">
                                                    <!-- delete -->
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$priceItem->id}}">
                                                        <input type="hidden" name="slug" value="{{$events->slug}}">
                                                            <button
                                                                type="submit"
                                                                class="btn btn-danger btn-user btn-block mb-4"
                                                                onclick="return confirm('Confirm Deleting {{$priceItem->priceTag}}?')">Delete</button>
                                                        </form>
                                                    </div>

                                                </div>

                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <script>
                                    const title = document.querySelector('#eventName');
                                    const slug = document.querySelector('#slug');

                                    title.addEventListener('change', function () {
                                        fetch('/dashboard/manage-event/slug?title=' + title.value)
                                            .then(
                                                response => response.json()
                                            )
                                            .then(data => slug.value = data.slug)
                                    });
                                </script>

                                @endsection