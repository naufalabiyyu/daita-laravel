<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cart;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Support\Facades\Storage;
use Exception;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // dd($request);
        // Save users data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // process Checkout
        $code = 'STORE-' . mt_rand(000000, 999999);
        $carts = Cart::with(['product', 'user'])
            ->where('users_id', Auth::user()->id_user)
            ->get();

        // Hitung total price
        $subtotal = 0;
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $subtotal += $cart->quantity * $cart->product->prices;
        }
        // Hitung pajak
        $pajak = intval((10/100) * $subtotal);

        // Hitung total price + pajak
        $totalPrice = $subtotal + $request->ongkir + $pajak;
        // tes, oii oke udah waras wkwkwk
        // gitu aja

         if($subtotal == 0){
            return redirect('/');
        }
        // Transaction create
        $transaction = Transaction::insertGetId([
            'code' => $code,
            'users_id' => Auth::user()->id_user,
            'sub_total' => $subtotal,
            'shipping_price' => $request->ongkir,
            'total_price' => $totalPrice,
            'transaction_status' => 'PROCESS', 
            'courier' => $request->couriers, 
            'service' => $request->services, 
            'resi' => '',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        foreach ($carts as $cart) {
            // Tambahkan transaksi detail

            TransactionDetail::create([
                'transactions_id' => $transaction,
                'products_id' => $cart->product->id_product,
                'prices' => $cart->product->prices,
                'quantity' => $cart->quantity
            ]);
        }

        // Delete Cart Data
        Cart::with(['product', 'user'])
            ->where('users_id', Auth::user()->id_user)
            ->delete();

        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat array untuk dikirm ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $totalPrice,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'bank_transfer'
            ],
            'vt_web' => []

        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getStatusMidtrans($orderId) {
        $auth = "Basic U0ItTWlkLXNlcnZlci1GVmxBM0RiUUNkb2NZZ0FOOVFDS0VPejA=";
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/" . $orderId . "/status",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS =>"\n\n",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: " . $auth,
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function midtranscancel()
    {
        return view('pages.midtrans.cancel');
    }

    public function midtransfinish(Request $request)
    {
        $code = $request->order_id;
        //pakai $code soalnya takut di pakai lagi kodenaya
        $db = Transaction::where('code',$code)->first();
        // $transactionMidtrans = $this->getStatusMidtrans($code);
        // itu redirect midtransnya ke localhost dulu oy
        // gua mau liat callbacknya
        
        // $this->callback($transactionMidtrans);
        // die(); //tuh bisa
        // return $db;
        return view('pages.midtrans.status',compact('db')); 
        //dah tinggal get aja di viewnya lanjut, diviewnya ya ?
        //iya jadi nggak usah redirect , bedain tulisan aja 
    }

    public function midtransunfinish()
    {
        //disini ya? $code = apa tadi
        //bukan, di finish
        return view('pages.midtrans.gagal');
    }

    public function midtranserror()
    {
        return view('pages.midtrans.error');
    }

    public function callback(Request $request)
    {

        // $request = json_decode($request);
        $transaction = $request->transaction_status;
        $fraud = $request->fraud_status;

        // Storage::put('file.txt', $transaction);
        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
              // TODO Set payment status in merchant's database to 'challenge'
              
              Transaction::where('code',$request->order_id)->update([
                'status_pay' => 'FAILED',
                'transaction_status' => 'PENDING'
            ]);
            return;
              
            }else if ($fraud == 'accept') {
              // TODO Set payment status in merchant's database to 'success'
              
              Transaction::where('code',$request->order_id)->update([
                'status_pay' => 'SUCCESS',
                'transaction_status' => 'PROCCESS'
            ]);
            return;
              
            }
        }else if ($transaction == 'cancel') {
            if ($fraud == 'challenge') {
              // TODO Set payment status in merchant's database to 'failure'
              Transaction::where('code',$request->order_id)->update([
                'status_pay' => 'FAILED',
                'transaction_status' => 'PENDING'
            ]);
            return;
              
            }else if ($fraud == 'accept') {
              // TODO Set payment status in merchant's database to 'failure'

              Transaction::where('code',$request->order_id)->update([
                'status_pay' => 'CANCEL',
                'transaction_status' => 'PENDING'
            ]);
            return;
            }
        }else if ($transaction == 'deny') {
            // TODO Set payment status in merchant's database to 'failure' 

            Transaction::where('code',$request->order_id)->update([
                'status_pay' => 'FAILED',
                'transaction_status' => 'PENDING'
            ]);
            return;
              
        }else if($transaction == 'pending') {
                Transaction::where('code',$request->order_id)->update([
                    'status_pay' => 'PENDING',
                    'transaction_status' => 'PENDING'
                ]);
            return;
        }else if($transaction == 'expire') {
            
            Transaction::where('code',$request->order_id)->update([
                'status_pay' => 'EXPIRED',
                'transaction_status' => 'PENDING'
            ]);
            return;
        }else if($transaction == 'accept') {
            
            Transaction::where('code',$request->order_id)->update([
                'status_pay' => 'SUCCESS',
                'transaction_status' => 'PROCESS'
            ]);
            return;
        }else if($transaction == 'settlement') {
            Transaction::where('code',$request->order_id)->update([
                'status_pay' => 'SUCCESS',
                'transaction_status' => 'PROCESS'
            ]);
            return;
        }
        echo json_encode('berhasil');
    }
}
