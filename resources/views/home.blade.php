@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col md-12">
        @if(Auth::user()->role == 'bank')
                <div class="row">
                    <div class="col-10">
                        <div class="row text-secondary">Welcome,</div>
                        <div class="row fw-bold" style="font-size: 25px;">
                            {{ Auth::user()->name}}
                        </div>
                    </div>
                    <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                        </svg>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Request Top Up</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Nasabah</th>
                                                <th>Permintaan Saldo</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($request_topup as $key => $request)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$request->user->username}}</td>
                                                <td>Rp. {{number_format($request->credit)}}</td>
                                                
                                                <form action="{{ route('request_topup') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id" value="{{ $request->id}}">
                                                    <td>
                                                    <button type="submit" class="btn btn-primary">SETUJU</button>
                                                    </td>
                                                </form>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header dw-bold">
                                Saldo
                            </div>
                            <div class="card-body">
                                Rp. {{number_format($saldo)}}
                            </div>
                            <div class="card-footer">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mutasi">
                                 <span>Lihat Detail</span>
                                </button>
                
                                    <!-- Modal -->
                                        <div class="modal fade" id="mutasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Nasabah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($wallets as $key => $wallet)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{$wallet->user->username}}</td>
                                                            <td>{{ $wallet->credit ? '+ Rp '.number_format($wallet->credit):'' }} {{ $wallet->debit ? '- Rp '.number_format($wallet->debit):''}}</td>
                                                            <td>{{ $wallet->description}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Top Up Sekarang</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header dw-bold">
                                Jumlah Nasabah
                            </div>
                            <div class="card-body">
                                {{ $nasabah }}
                            </div>
                            <div class="card-footer">
                                 <!-- Button trigger modal -->
                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#JumlahNasabah">
                                 <span>Lihat Detail</span>
                            </button>
            
                                <!-- Modal -->
                                    <div class="modal fade" id="JumlahNasabah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Nasabah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($daftar_user as $key => $user)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$user->username}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Top Up Sekarang</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header dw-bold">
                                Jumlah Transaksi
                            </div>
                            <div class="card-body">
                                {{ $transactions }}
                            </div>
                        </div>
                    </div>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Nasabah</th>
                                <th>Saldo</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wallets as $key => $request)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$request->user->username}}</td>
                                <td>{{ $request->credit ? '+ Rp '.number_format($request->credit):'' }} {{ $request->debit ? '- Rp '.number_format($request->debit):''}}</td>
                                <td>{{ $request->description}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        @endif
        @if(Auth::user()->role == 'siswa')
            <div class="container mb-3">
                <div class="text-center">
                    <div class="row">
                        <div class="col">
                            <div class="row text-secondary">Welcome,</div>
                            <div class="row fw-bold" style="font-size: 25px;">
                                {{ Auth::user()->name}}
                            </div>
                        </div>
                    </div>
                    <div class="row text-bg-primary p-3" style="height: 170px;">
                        <div class="col">
                            <div class="row">
                                <div class="col">Saldo Anda: </div>
                            </div>
                            <div class="row"style="font-size:50px;">
                                <div class="col">Rp {{ number_format($saldo) }}</div>
                            </div>
                            <div class="col d-flex justify-content-center align-items-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet" viewBox="0 0 16 16">
                                    <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z"/>
                                </svg> <span>Top Up</span>
                            </button>
            
                                <!-- Modal -->
                                <form action="{{ route('TopUpNow') }}" method="post">
                                    @csrf
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input type="number" name="credit" value="10000" class="form-control" min="10000"   >
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Top Up Sekarang</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header text-bg-primary fw-bold text-center">Products</div>
                <div class="card-body">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-4">
                            <form action="{{ route('addToCart') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->id}}" name="user_id">
                                <input type="hidden" value="{{ $product->id}}" name="product_id">
                                <input type="hidden" value="{{ $product->price}}" name="price">
                                <div class="card">
                                    <div class="card-header">
                                        {{ $product->name }}
                                    </div>
                                    <div class="card-body">
                                        <img style="width: 150px; height:150px;" src="images/{{ $product->photo }}">
                                        <div>{{$product->desc}}</div>
                                        <div>Harga: {{ $product->price }}</div>
                                        <div>Stock: {{ $product->stock }}</div>
                                    </div>  
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min='1'>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="d-grip gap-2">
                                                    <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                        </svg> <span style="font-size: 12px;">Tambah</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header text-bg-primary fw-bold text-center">
                    Baskets
                </div>
                <div class="card-body">
                    @foreach($carts as $cart)
                    <div class="row mb-2">
                        <div class="col-9">
                            <ul>
                            <li>
                                @if($cart->product->stock<= 0)
                                <s>
                                    @endif
                                    {{ $cart->product->name }} | {{ $cart->quantity}} x Rp {{ number_format($cart->price) }}
                                    
                                @if($cart->product->stock<= 0)
                                </s>
                                @endif
                                </li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <form action="{{route('DeleteBaskets',['id'=>$cart->id])}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">X</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    Total Biaya: {{ $total_biaya }}
                    <form action="{{ route('payNow')}}" method="POST">
                        <div class="d-grip gap-2">
                            @csrf
                            <button type="submit" class="btn {{$saldo < $total_biaya ? 'btn-secondary':'btn-success'}}">Bayar Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    Transactions History
                </div>
                <div class="card-body">
                    @foreach($transactions as $key => $transaction)
                    <div class="row mb-3">
                        <div class="col">
                            <div class="row">
                                <div class="col fw-bold">
                                    {{ $transaction[0]->order_id}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-secondary" style="font-size: 12px;">
                                    {{$transaction[0]->created_at}}
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-end align-items-center">
                            <a href="{{ route('download', ['order_id' => $transaction[0]->order_id]) }}" class="btn btn-success" target="blank">Download</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header text-center fw-bold text-bg-primary">
                    Mutasi Wallet
                </div>
                @foreach($mutasi as $data)
                <div class="card-body container">
                    <div class="row">
                        <div class="col-8">
                            <div class="row fw-bold">{{$data->description}} </div>
                            <div class="row text-secondary" style="font-size: 10px;">{{$data->created_at}}</div>
                        </div>
                        <div class="col-4">{{ $data->credit ? '+ Rp '.number_format($data->credit):'' }} {{ $data->debit ? '- Rp '.number_format($data->debit):''}}
                        <span class="badge text-bg-warning">{{$data->status == 'proses' ? 'PROSES' : ''}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@if (Auth::user()->role == 'kantin')
            <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                Menu
                            </div>
                            <div class="card-body">
                                @include('components.sidebar_kantin')
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex justify-content-start align-items-start">Home</div>
                                    </div>
                                    <div class="col-3">
                                        <div class="col d-flex justify-content-end align-items-end">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary text-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <span>Tambah</span>
                                                </button>
                                                <!-- Modal -->
                                                <form action="{{ route('product.store')}}" method="post">
                                                    @csrf
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Product</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col mb-3">
                                                                        <label>Nama</label>
                                                                        <input type="text"name="name" class="form-control">
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label>Price</label>
                                                                        <input type="number"name="price" class="form-control">
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label>Stock</label>
                                                                        <input type="number"name="stock" class="form-control">
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label>Stand</label>
                                                                        <input type="number"name="stand" class="form-control">
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label>Category</label>
                                                                        <select name="category_id" class="form-control">
                                                                            <option value="">Pilih Opsi</option>
                                                                            @foreach($categories as $category)
                                                                                <option value="{{ $category->id}}">{{$category->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col mb-3">
                                                                    <label>Photo</label>
                                                                    <input type="file"name="photo" class="form-control">
                                                                </div>
                                                                <div class="col mb-3">
                                                                    <label>Description</label>
                                                                    <textarea name="description" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($products as $key => $product)
                                        <div class="col-4 mb-3">
                                            <div class="card">
                                                <div class="card-header bg-success-subtle" style="font-size: 16px">
                                                    {{$product->name}}
                                                </div>
                                                <div class="card-body text-center" style="font-size: 15px">
                                                    <img src="images/{{$product->photo}}" alt="" width="200" height="200" class="mb-2">
                                                    {{-- <img src="https://source.unsplash.com/150x150/?esteh" alt=""> --}}
                                                    <div>Desc: {{$product->desc}}</div>
                                                    <div>Harga: {{ $product->price }}</div>
                                                    <div>Kategori: {{ $product->category->name }}</div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <div class="col">
                                                        <button type="button" class="btn btn-warning text-end" data-bs-toggle="modal" data-bs-target="#edit-{{$product->id}}">
                                                <span>Edit</span>
                                                </button>
                                                <!-- Modal -->
                                                <form action="{{ route('product.update',['id'=>$product->id]) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal fade" id="edit-{{$product->id}}" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="editLabel">Edit Product</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col mb-3">
                                                                        <label>Nama</label>
                                                                        <input value="{{$product->name}}" type="text"name="name" class="form-control">
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label>Price</label>
                                                                        <input value="{{$product->price}}" type="number"name="price" class="form-control">
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label>Stock</label>
                                                                        <input value="{{$product->stock}}" type="number"name="stock" class="form-control">
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label>Stand</label>
                                                                        <input value="{{$product->stand}}" type="number"name="stand" class="form-control">
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label>Category</label>
                                                                        <select name="category_id" class="form-control">
                                                                            <option>Pilih Opsi</option>
                                                                                @foreach($categories as $category)
                                                                                <option value="{{ $category->id}}"{{ $product->category_id == $category->id ? 'selected':'' }}>{{$category->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label>Photo</label>
                                                                        <input value="{{$product->photo}}" type="file"name="photo" class="form-control">
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label>Description</label>
                                                                        <textarea name="description" class="form-control">{{$product->desc}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                        </div>
                                                        <div class="col">
                                                            <!-- Button trigger modal -->
                                                            <div class="text-end">
                                                                <button type="button" class="btn btn-danger text-end" data-bs-toggle="modal" data-bs-target="#delete-{{$product->id}}">
                                                                delete
                                                                </button>
                                                            </div>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="delete-{{$product->id}}" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="deleteLabel">Delete</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah Anda Yakin Akan Menghapus Product {{$product->name}}?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <form action="{{ route('product.destroy',['id'=>$product->id]) }}" method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                        <button type="submit" class="btn btn-success">Delete</button>
                                                                    </form>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header text-bg-primary fw-bold text-center">
                                        Request Pengambilan Pesanan
                                    </div>
                                    <div class="card-body">
                                        @foreach($transactions as $transaction)
                                        <div class="card">
                                            <div class="card-header">{{ $transaction->user->name}}</div>
                                            <div class="card-body">
                                                {{$transaction->product->name }} x {{$transaction->quantity}} | Stand {{$transaction->product->stand   }}
                                            </div>
                                            <div class="card-footer">
                                            <form action="{{route('transaction.take',['id'=>$transaction->id])}}" method="POST">
                                                    <div class="d-grid gap-2">
                                                        @csrf
                                                        <button class="btn btn-success" type="submit">Sudah Diambil</button>
                                                    </div>
                                            </form>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::user()->role == 'admin')
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-header">Sidebar</div>
                    <div class="card-body">
                        @include('components.sidebar_admin')
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">Jumlah User</div>
                            <div class="card-body">{{ $nasabah }}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">Jumlah Transaksi</div>
                            <div class="card-body">{{ $transactions }}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">Jumlah Produk</div>
                            <div class="card-body">{{ $product }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
   </div>
</div>

@endsection
