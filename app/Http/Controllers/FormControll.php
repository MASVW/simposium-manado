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
                "fullName" => $data[$saved->bucket_id][0],
                "phone" => $data[$saved->bucket_id][1],
                "email" => $data[$saved->bucket_id][2]
            ]);
        };
        return redirect('/')->with('success', 'Filling Form!');
        }
        else{
          $saved = Datas::where("payments_id", $payments->id)->first();
          Datas::where("buckets_id", $saved->buckets_id)->update([  
            "isFilled" => 1,              
            "fullName" => $data[$saved->buckets_id][0],
            "phone" => $data[$saved->buckets_id][1],
            "email" => $data[$saved->buckets_id][2]
        ]);
        return redirect('/')->with('success', 'Filling Form!');
        }
        
      }
}
