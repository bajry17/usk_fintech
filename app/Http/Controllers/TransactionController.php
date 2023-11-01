<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function addToCart(Request $request)
    {
        $user_id = $request->user_id;
        $product_id = $request->product_id;
        $status = 'dikeranjang';
        $price = $request->price;
        $quantity = $request->quantity;

        if($quantity == 0)
        {
            return redirect()->back()->with('status', 'Silahkan Isi Jumlah Produk');
        }
        else
        {
            Transaction::create([
                'user_id'=>$user_id,
                'product_id'=>$product_id,
                'status'=>$status,
                'price'=>$price,
                'quantity'=>$quantity,
            ]);
    
            return redirect()->back()->with('status', 'Berhasil Menambah Keranjang');
        }

     }

     public function payNow()
     {
        $status = 'dibayar';
        $order_id = 'INV_' . Auth::user()->id . date('YMdHis');
        $wallets = Wallet::where('user_id', Auth::user()->id)->where('status', 'selesai')->get();
            $credit = 0;
            $debit = 0;
            foreach($wallets as $wallet)
            {
                $credit += $wallet->credit;
                $debit += $wallet->debit;
            }
            $saldo = $credit - $debit;
        $carts = Transaction::where('user_id', Auth::user()->id)->where('status', 'dikeranjang')->get();
        $total_debit = 0;

        foreach($carts as $cart){
            $total_price = $cart->price * $cart->quantity;
            $total_debit += $total_price;
        }
        if($saldo < $total_debit){
            return redirect()->back()->with('status', 'Saldo Anda Tidak Mencukupi');
        }
        elseif($total_debit == 0)
        {
            return redirect()->back()->with('status', 'Keranjang Kosong');
        }
        else{
            Wallet::create([
                'user_id' => Auth::user()->id,
                'debit' => $total_debit,
                'description' => 'pembelian produk'
            ]);
            foreach($carts as $cart)
            {
                Transaction::find($cart->id)->update([
                    'status' => $status,
                    'order_id' => $order_id
                ]);
            }
    
            return redirect()->back()->with('status', 'Berhasil Membayar Transaksi');
        }

     }
     public function download($order_id)
     {
        $transactions = Transaction::where('order_id', $order_id)->get();

        $total_biaya = 0;

        foreach($transactions as $transaction){
            $total_price = $transaction->price * $transaction->quantity;

            $total_biaya += $total_price;
        }
        return view('receipt', compact('transactions', 'total_biaya'));
     }
     public function take($id)
     {
        Transaction::find($id)->update([
            'status' => 'diambil',
        ]);

        return redirect()->back()->with('status', 'pesanan sudah diambil');
 
     }

     public function DeleteBaskets($id)
     {
        $delete = Transaction::find($id)->delete();

        if ($delete)
        {
            return redirect('/home')->with('status', 'Berhasil menghapus produk dari keranjang');
        }
        else
        {
            return redirect('/home')->with('status','Gagal menghapus produkd ari keranjang');
        }
     }

}
