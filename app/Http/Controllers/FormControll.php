<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use App\Models\Datas;
use App\Models\Jobs;
use App\Models\Payment;
use Illuminate\Http\Request;

class FormControll extends Controller
{
    public function index(Payment $payments){
        return view('form',[
            'title' => 'Form',
            'payment' => $payments->id,
            'bucket' => Bucket::where("payments_id", $payments->id)->with('prices', 'payments', 'events')->get(),
            'id' => 0,
        ]);
    }
    public function store(Request $request, Payment $payments){
        
        $variabel = $request->except('_token');
        $data = [];

        foreach ($variabel as $key => $value) {
          $parts = explode ('?', $key);
          if (count($parts) > 1) {
            $data[$parts[1]][]= $value;
          }
        }

        $i = count($data);

        if ($i > 1) {
          $saved = Datas::where("payments_id", $payments->id)->get();
          foreach ($saved as $saved) {
            Datas::where("buckets_id", $saved->buckets_id)->update([  
                "isFilled" => 1,              
                "fullName" => $data[$saved->buckets_id][0],
                "phone" => $data[$saved->buckets_id][1],
                "email" => $data[$saved->buckets_id][2]
            ]);
          };
        }
        else{
          $saved = Datas::where("payments_id", $payments->id)->first();
          Datas::where("buckets_id", $saved->buckets_id)->update([  
            "isFilled" => 1,              
            "fullName" => $data[$saved->buckets_id][0],
            "phone" => $data[$saved->buckets_id][1],
            "email" => $data[$saved->buckets_id][2]
          ]);
        }

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $payments->id,
                'gross_amount' => $payments->total,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->firstName,
                'last_name' => auth()->user()->lastName,
                'email' => auth()->user()->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        setcookie($payments->id, $snapToken, time() + 86400, "/");

        return view("payment", 
                [
                    'title' => "Check Out",
                    'id' => 1,
                ], compact('snapToken','payments'));
      }
}
