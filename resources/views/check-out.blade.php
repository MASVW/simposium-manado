@extends('layouts.main') @section('check-out')

<div
    class="main-banner wow fadeIn"
    id="top"
    data-wow-duration="1s"
    data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Confirm Items</h2>
                    <hr class="mt-3">
                    <?php 
        use App\Models\Bucket;
        use Illuminate\Support\Facades\Session;
        $item = Bucket::whereIn('id', (array) Session::get('data'))->with('prices', 'events')->get();

        ?>
                </div>
                <?php $i=0;?>
                @foreach($item as $item)
                <?php $i++?>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th scope="row"></th>
                            <td colspan="3">{{$item->events->eventName}}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td colspan="3">{{$item->prices->priceTag}}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td colspan="1">{{$item->events->slug}}</td>
                        </tr>
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td colspan="2">Date :
                                {{$item->events->eventDate}}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td style="width: 80%;"> </td>
                            <td>Rp.  {{$item->prices->price}}</td>
                            <td>
                                <form action="{{route('delete_item')}}" method="post">
                                    @csrf
                                    <button
                                        type="submit"
                                        name="delete"
                                        value="{{$loop->index}}"
                                        class="btn btn-outline-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="mt-3">
                @endforeach
            </div>
            <div class="col-lg-12">
              <div class="d-flex flex-row-reverse">
                <form action="{{route('payment')}}" method="post">
                  @csrf
                  <button type="submit"  class="btn btn-primary">
                    Check Out
                  </button>
                </form>
              </div>
            </div>
        </div>
      </div>
</div>

@endsection