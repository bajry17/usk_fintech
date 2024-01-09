<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Guru;
use App\Models\Product;
use App\Models\Stand;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),                   
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Tenizen bank',
            'username' => 'bank',
            'password' => Hash::make('bank'), 
            'role' => 'bank'
        ]);
        User::create([
            'name' => 'Tenizen Marketing',
            'username' => 'kantin',
            'password' => Hash::make('kantin'),
            'role' => 'kantin'
        ]);
        User::create([
            'name' => 'Raihan',
            'username' => 'raihan',
            'password' => Hash::make('raihan'),
            'role' => 'siswa'
        ]);
        User::create([
            'name' => 'Bajry',
            'username' => 'bajry',
            'password' => Hash::make('bajry'),
            'role' => 'siswa'
        ]);
        Student::create([
            'user_id' => 4,
            'nis' => 12332,
            'classroom' => 'XII RPL'
        ]);

        Category::create([
            'name' => 'Minuman'
        ]);
        Category::create([
            'name' => 'Makanan'
        ]);
        Category::create([
            'name' => 'Snack'
        ]);

        Product::create([
            'name' => 'Lemon Ice Tea',
            'price' => 5000,
            'stock' => 100,
            'photo' =>'jsjooq',
            'desc' => 'Ice Lemon',
            'category_id' => 1,
            'stand' => 2
        ]);
        Product::create([
            'name' => 'Meat Ball',
            'price' => 10000,
            'stock' => 50,
            'photo' =>'jsjooq',
            'desc' => 'Bakso Daging',
            'category_id' => 2,
            'stand' => 1
        ]);
        Product::create([
            'name' => 'Risoles',
            'price' => 3000,
            'stock' => 50,
            'photo' =>'jsjooq',
            'desc' => 'Risol',
            'category_id' => 3,
            'stand' => 1
        ]);

        Wallet::create([
            'user_id' => 4,
            'credit' => 100000,
            'debit' => null,
            'description' => 'pembukaan tabungan'
        ]);
        Wallet::create([
            'user_id' => 4,
            'credit' => null,
            'debit' => 15000,
            'description' => 'peembelian produk'
        ]);
        Wallet::create([
            'user_id' => 4,
            'credit' => null,
            'debit' => 15000,
            'description' => 'peembelian produk'
        ]);
        Transaction::create([
            'user_id' => 4,
            'product_id' => 1,
            'status' => 'dikeranjang',
            'order_id' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);

        Transaction::create([
            'user_id' => 4,
            'product_id' => 2,
            'status' => 'dikeranjang',
            'order_id' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);
        Transaction::create([
            'user_id' => 4,
            'product_id' => 3,
            'status' => 'dikeranjang',
            'order_id' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);

        
        $total_debit = 0;
        
        $transactions = Transaction::where('order_id'==
        'INV_12345');
        foreach($transactions as $transaction)
        {
            $total_price = $transaction->price * $transaction->quantity;

            $total_debit += $total_price;
        }
        Wallet::create([
            'user_id' => 4,
            'debit' => $total_debit,
            'description' => 'pembelian produk'
        ]);
        foreach($transactions as $transaction)
        {
            Transaction::find($transaction->id)->update([
                'status' => 'dibayar'
            ]);
        }
        foreach($transactions as $transaction)
        {
            Transaction::find($transaction->id)->update([
                'status' => 'diambil'
            ]);
        }

        Stand::create([
            'name' => 'Stand 1',
            'kelas' => 'XII',
            'jurusan' => 'RPL'
        ]);
        Stand::create([
            'name' => 'Stand 2',
            'kelas' => 'XII',
            'jurusan' => 'OTKP'
        ]);
        Stand::create([
            'name' => 'Stand 3',
            'kelas' => 'XII',
            'jurusan' => 'AKL'
        ]);
        Stand::create([
            'name' => 'Stand 4',
            'kelas' => 'XII',
            'jurusan' => 'BDP'
        ]);
        Guru::create([
            'name' => 'Pak Mujahid',
            'gender' =>'laki-laki'
        ]);
        Guru::create([
            'name' => 'Pak Aroh',
            'gender' =>'laki-laki'
        ]);
        Guru::create([
            'name' => 'Bu Eri',
            'gender' =>'perempuan'
        ]);
    }
}
