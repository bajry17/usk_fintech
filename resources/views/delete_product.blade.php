@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Auth::user()->role == 'kantin')
            <div class="alert alert-success" role="alert">
                {{ session('status')}}
            </div>
        @endif
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    Menu
                </div>
                <div class="card-body">
                    @include('components.sidebar_kantin')
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    Delete Product
                </div>
                <div class="card-body">
                    <form action="{{ route('product.deleteProductCard') }}" method="post">
                        @csrf
                        <label class="mb-3">Pilih Product</label>
                        <div class="row">
                            <div class="col">
                                <select name="product_id">
                                    <option value="">Pilih Opsi</option>
                                    @foreach($products as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <div class="d-grip gap-2">
                                    <button type="submit" class="btn btn-primary">Pilih</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if($product !== '')
                        <div class="card-mb-3">
                            <div class="card-header">{{ $product->name}}</div>
                            <div class="card-body">
                                <img src="/images/{{$product->photo}}">
                                <div> {{ $product->description }} </div>
                                <div>Harga : {{$product->price}}</div>
                                <div>Kategori : {{$product->category->name }}</div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <form action="{{ route('product.destroy') }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-sm btn-success">Yes</button>
                                        </form>
                                    </div>
                                    <div class="col text-end">
                                        <a href="" class="btn btn-sm btn-danger">No</a>
                                    </div>
                                </div>
                             </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection