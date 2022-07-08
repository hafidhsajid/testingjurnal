<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        //save user data
        $user = Auth::user();           //memanggil user yang sedang login
        $user->update($request->except('total_price', 'shipping_price'));         //mengupdate data dari checkout kedalam table user kecuali totalprice karna tidak ada element tersebut

        //proses checkout
        $code = 'STORE-'. mt_rand(000000,999999);
        $carts = Cart::with('product', 'user')->where('users_id', Auth::user()->id)->get();

        //Buat transaksi
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurace_price' => 0,
            'shipping_price' => $request->shipping_price,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code,
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-'. mt_rand(000000,999999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx,
            ]);

            // Mengurangi stok produk
            $cart->product->decrement('stock', $cart->quantity);
        }

        //hapus data di cart setelah belanja/checkout
        Cart::where('users_id', Auth::user()->id)->delete();


        //konfigurasi ke midtrans
            Config::$serverKey = "SB-Mid-server-znrFEsDQHBnCz10WVBND7Xs_";
            Config::$isProduction = false;
            Config::$isSanitized = false;
            Config::$is3ds = true;

        //buat array untuk di push ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtweb' => [],
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function callback(Request $request)
    {
        //set konfigurasi ke midtransa
        config::$serverKey = config('services.midtrans.serverKey');
        config::$isProduction = config('services.midtrans.isProduction');
        config::$isSanitized = config('services.midtrans.isSanitized');
        config::$is3ds = config('services.midtrans.is3ds');

        //instance notifikasi midtrans
        $notification = new Notification();

        //deklarasi variable midtrans dari dokumentasi Midtrans
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        //handle notifikasi status
        if($status == 'capture') {
            if($type == 'credit_card') {
                if($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                }
                else {
                    $transaction->status = 'SUCCESS';
                }
            }
        }

        else if($status == 'settlement') { //kondisi berdasarkan dari Midtrnas
            $transaction->status = 'SUCCESS'; //mengubah status yang ada di DB
        }
        else if($status == 'pending') {
            $transaction->status = 'PENDING'; //mengubah status yang ada di DB
        }
        else if($status == 'deny') {
            $transaction->status = 'CANCELLED'; //mengubah status yang ada di DB
        }
        else if($status == 'expire') {
            $transaction->status = 'CANCELLED'; //mengubah status yang ada di DB
        }
        else if($status == 'cancel') {
            $transaction->status = 'CANCELLED'; //mengubah status yang ada di DB
        }

        //simpan transaksi
        $transaction->save();

    }
}
