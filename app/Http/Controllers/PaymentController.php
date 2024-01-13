<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use App\Models\Datas;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index(Payment $payments){
        $items = Bucket::where("payments_id", $payments->id)->get();
        foreach ($items as $item) {
            session(['data' => $item->id]);
        }
        return view("re-check-out", [
            "payments" => $payments,
            "title" => 'Recheck Out',
            'id'=> '1',
        ]);
    }
    public function create(){
        $total = Bucket::whereIn('buckets.id', (array) Session::get('data'))
        ->join('prices', 'buckets.priceS_id', '=', 'prices.id')
        ->sum('prices.price');
        $data = [
            'id'=> rand(234, 989876724244654),
            'users_id'=> auth()->user()->id,
            'total' => $total,
        ];
        $payment = Payment::create($data);
        Bucket::whereIn('id', (array) Session::get('data'))->update([
            'payments_id'=> $payment->id
        ]);
        
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $payment->id,
                'gross_amount' => $payment->total,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->firstName,
                'last_name' => auth()->user()->lastName,
                'email' => auth()->user()->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        setcookie($payment->id, $snapToken, time() + 86400, "/");
        return view("payment", 
        [
            'title' => "Check Out",
            'id' => 1,
        ],
        compact("snapToken","payment"));
    }


    public function callback(Request $request){
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == "capture" || $request->transaction_status == "settlement") {
                
                $order = Payment::find($request->order_id);
                $order->update(['status' => 'Paid']);
                $savedItems = Bucket::where("payments_id", $order->id)->with('prices', 'events')->get();
                foreach ($savedItems as $saved) {
                    $data = Datas::create([
                        "users_id"=> $saved->users_id,
                        "buckets_id"=> $saved->id,
                        "positions_id" => $saved->prices->position_id,
                        "payments_id" => $saved->payments_id,
                        "isFilled" => 0,
                        "eventName" => $saved->events->eventName,
                    ]);
                    $saved->update(['datas_id' => $data->id]);
                }
                };
            };
    }
    public function invoice(Payment $payments){
        return view('invoice',[
            'payment' => $payments->id,
            'title' => 'Invoice',
            'id' => 0,
        ]);
    }
    public function update(Payment $payments){

        if(isset($_COOKIE[$payments->id])) {
            $snapToken = $_COOKIE[$payments->id];
        } else {
            // Cookie 'snapToken' tidak ada.
            $snapToken = null;
        }
        return view("payment", 
        [
            'title' => "Check Out",
            'id' => 1,
            'snapToken' => $snapToken,
            'payment' => $payments
        ]);
    }
}
