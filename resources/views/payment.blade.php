@extends('layouts.main') @section('payment')

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
                        $item = Bucket::whereIn('payments_id', $payments)->with('prices', 'events')->get();
                    ?>
                </div>
                <?php $i=0;$total=0;?>
                @foreach($item as $item)
                <?php $i++;$total+=$item->prices->price;?>
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
                            <td style="width: 80%;"></td>
                            <td>IDR {{ number_format($item->prices->price, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
                <hr class="mt-3">
                @endforeach
            </div>
            <div class="col-lg-12">
              <div class="d-flex flex-row-reverse mb-3">
                Total : IDR {{ number_format($total, 2, ',', '.') }}
              </div>
              <div class="d-flex flex-row-reverse">
                <form action="{{route('payment')}}" method="post">
                  @csrf
                  <button type="button"  class="btn btn-primary" id="pay-button">
                    Pay Now!
                  </button>
                </form>
              </div>
            </div>
        </div>
      </div>
</div>

<script type="text/javascript">
            // For example trigger on button clicked, or any time you need
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function () {
                window.snap.pay('{{$snapToken}}', {
                onSuccess: function(result){
                    /* You may add your own implementation here */
                    // alert("payment success!"); console.log(result);
                    window.location.href = '/invoice/{{$payments->id}}'
                },
                onPending: function(result){
                    /* You may add your own implementation here */
                    alert("wating your payment!"); console.log(result);
                },
                onError: function(result){
                    /* You may add your own implementation here */
                    alert("payment failed!"); console.log(result);
                },
                onClose: function(){
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
                })
            });
</script>

@endsection