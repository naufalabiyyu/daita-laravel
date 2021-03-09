<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cart;
use App\Transaction;
use App\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;


class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Save users data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // process Checkout
        $code = 'STORE-' . mt_rand(000000, 999999);
        $carts = Cart::with(['product', 'user'])
            ->where('users_id', Auth::user()->id)
            ->get();

        // Hitung total price
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->quantity * $cart->product->prices;
        }

        // Transaction create
        $transaction = Transaction::insertGetId([
            'users_id' => Auth::user()->id,
            'shipping_price' => 0,
            'total_price' => $totalPrice,
            'transaction_status' => 'PENDING',
            'code' => $code,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(000000, 999999);

            TransactionDetail::create([
                'transactions_id' => $transaction,
                'products_id' => $cart->product->id,
                'prices' => $cart->product->prices,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx,
                'quantity' => $cart->quantity
            ]);
        }

        // Delete Cart Data
        Cart::with(['product', 'user'])
            ->where('users_id', Auth::user()->id)
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

    public function callback(Request $request)
    {
    }
}
