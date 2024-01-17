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
      $buckets = Bucket::where("payments_id", $payments->id)->with('prices', 'payments', 'events', 'datas')->get();

      // $dataNames = null;
      $dataNames = $buckets->pluck('datas.fullName')->toArray();

      return view('form', [
          'title' => 'Form',
          'payment' => $payments->id,
          'bucket' => $buckets,
          'data' => $dataNames,
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
                "instance" => $data[$saved->buckets_id][2],
                "email" => $data[$saved->buckets_id][3]
            ]);
          };
        }
        else{
          $saved = Datas::where("payments_id", $payments->id)->first();
          Datas::where("buckets_id", $saved->buckets_id)->update([  
            "isFilled" => 1,              
            "fullName" => $data[$saved->buckets_id][0],
            "phone" => $data[$saved->buckets_id][1],
            "instance" => $data[$saved->buckets_id][2],
            "email" => $data[$saved->buckets_id][3]
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
      public function update(Request $request, Payment $payments){
        $buckets = Bucket::where("payments_id", $payments->id)->with('prices', 'payments', 'events', 'datas')->get();

      // $dataNames = null;
        $dataNames = $buckets->pluck('datas.fullName')->toArray();

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
                  "instance" => $data[$saved->buckets_id][2],
                  "email" => $data[$saved->buckets_id][3]
              ]);
            };
          }
          else{
            $saved = Datas::where("payments_id", $payments->id)->first();
            Datas::where("buckets_id", $saved->buckets_id)->update([  
              "isFilled" => 1,              
              "fullName" => $data[$saved->buckets_id][0],
              "phone" => $data[$saved->buckets_id][1],
              "instance" => $data[$saved->buckets_id][2],
              "email" => $data[$saved->buckets_id][3]
            ]);
          }
          return view('form', [
            'title' => 'Form',
            'payment' => $payments->id,
            'bucket' => $buckets,
            'data' => $dataNames,
            'id' => 0,
        ]);
      }
}
