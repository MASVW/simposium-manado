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
    public function callback(Request $request){
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == "capture" || $request->transaction_status == "settlement") {
                $email = new MailController();
                $order = Payment::find($request->order_id);
                $firstName = $order->users->firstName;
                $lastName = $order->users->lastName;
                $userEmail = $order->users->email;
                $order->update([
                    'status' => 'Paid',
                    'metode' => $request->payment_type,
                ]);
                $email->successPayment($firstName, $lastName, $order->id, $userEmail);
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
            'payments' => $payments
        ]);
    }
}
