<?php

namespace App\Http\Controllers;
use App\Models\Bucket;
use App\Models\Datas;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    public function index(Request $request)
    {
        Session::put('data', $request->data);
        $data = Session::get('data');
        
        if ($data != []) {
            $cek = Datas::whereIn('buckets_id', (array) Session::get('data'))->first();
            if (!$cek) {
                $total = Bucket::whereIn('buckets.id', (array) Session::get('data'))
                    ->join('prices', 'buckets.priceS_id', '=', 'prices.id')
                    ->sum('prices.price');
                    
                $variabel = [
                    'id'=> rand(234, 989876724244654),
                    'users_id'=> auth()->user()->id,
                    'total' => $total,
                ];
                $payment = Payment::create($variabel);

                Bucket::whereIn('id', (array) Session::get('data'))->update([
                    'payments_id'=> $payment->id
                ]);
                
                $savedItems = Bucket::where("payments_id", $variabel['id'])
                    ->with('prices', 'events')
                    ->get();

                foreach ($savedItems as $saved) {
                    $item = Datas::create([
                        "users_id"=> $saved->users_id,
                        "buckets_id"=> $saved->id,
                        "positions_id" => $saved->prices->position_id,
                        "payments_id" => $saved->payments_id,
                        "isFilled" => 0,
                        "events_id" => $saved->events->id,
                    ]);
                    $saved->update(['datas_id' => $item->id]);
                }
                return view("check-out",[
                    'title' => "Check Out",
                    'id' => 1
                ],
                compact('payment'));
            }
            else{
                $id = $cek->payments_id;
                $payment = Payment::where('id', $id)->first();
                return view("check-out",[
                    'title' => "Check Out",
                    'id' => 1],
                compact('payment'));
            }
        }
        return redirect('/')->with('error','Please Select At Least 1 Item');
    }
    public function recheckout()
    {
            return view("check-out",[
                'title' => "Check Out",
                'id' => 1]);
    }
    public function delete(Request $request)
    {
        $index = $request->input('delete');

        $data = session('data');

        array_splice($data, $index, 1);

        session(['data' => $data]);
        Bucket::where('id', $request->buckets_id)->delete();
        Datas::where('id', $request->datas_id)->delete();
        Payment::where('id', $request->payments_id)->delete();

        $payment = Payment::where('id', $request->payments_id)->first();

        return view("check-out",[
            'title' => "Check Out",
            'id' => 1
        ], compact('payment'));
    }
}
