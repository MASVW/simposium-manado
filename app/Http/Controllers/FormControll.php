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
        // dd($i);
        if ($i > 1) {
          $saved = Datas::where("payment_id", $payments->id)->get();
          foreach ($saved as $saved) {
            Datas::where("bucket_id", $saved->bucket_id)->update([  
                "isFilled" => 1,              
                "fullName" => $data[$saved->bucket_id][0],
                "phone" => $data[$saved->bucket_id][1],
                "email" => $data[$saved->bucket_id][2]
            ]);
        };
        return redirect('/')->with('success', 'Filling Form!');
        }
        else{
          $saved = Datas::where("payment_id", $payments->id)->first();
          Datas::where("bucket_id", $saved->bucket_id)->update([  
            "isFilled" => 1,              
            "fullName" => $data[$saved->bucket_id][0],
            "phone" => $data[$saved->bucket_id][1],
            "email" => $data[$saved->bucket_id][2]
        ]);
        return redirect('/')->with('success', 'Filling Form!');
        }
        
      }
    // public function store(Request $request, Payment $payments){
    //     $data =[];
    //     // Misalkan $request adalah data request yang Anda dapatkan dari form
    //     foreach ($request as $key => $value) {
    //         // Misalkan separator adalah tanda tanya (?)
    //         $parts = explode ('?', $key);
    //         // Jika key memiliki separator, maka tambahkan value ke dalam array $data dengan menggunakan id bucket sebagai indeks
    //         if (count($parts) > 1) {
    //         $data[$parts[1]][] = $value;
    //         }
    //     }
    //     dd($data);
    // }
}
