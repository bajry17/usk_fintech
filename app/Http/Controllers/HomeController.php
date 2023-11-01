<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role == "bank"){
            $wallets = Wallet::where('status', 'selesai')->where('user_id', '4')->get();
            $credit = 0;
            $debit = 0;
            foreach($wallets as $wallet)
            {
                $credit += $wallet->credit;
                $debit += $wallet->debit;
            }
            $saldo = $credit - $debit;
            
            $nasabah = User::where('role', 'siswa')->get()->count();
            $daftar_user = User::where('role', 'siswa')->get();
            $daftar_transaksi = Transaction::where('user_id', '4')->get();

            $transactions = Transaction::all()->count();
            $request_topup = Wallet::where('status', 'proses')->get();

            return view('home', compact('saldo', 'nasabah', 'transactions', 'request_topup','daftar_user','daftar_transaksi','wallets'));
        }
        if(Auth::user()->role == "siswa"){

            $wallets = Wallet::where('user_id', Auth::user()->id)->where('status', 'selesai')->get();
            $credit = 0;
            $debit = 0;
            foreach($wallets as $wallet)
            {
                $credit += $wallet->credit;
                $debit += $wallet->debit;
            }
            $saldo = $credit - $debit;
            $products = Product::all();
            $carts = Transaction::where('status', 'dikeranjang')->where('user_id', Auth::user()->id)->get();
    
            $total_biaya = 0;
    
            foreach($carts as $cart){
                $total_price = $cart->price * $cart->quantity;
                $total_biaya += $total_price;
            }
    
            $mutasi = Wallet::where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->get();
            $transactions = Transaction::where('status', 'diambil')->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5)->groupBy('order_id');
            
            return view('home', compact('products', 'carts', 'saldo', 'total_biaya','mutasi','transactions'));
        }
    }
}
