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
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">Add Product</div>
                <div class="card-body">
                    <form action="{{ route('product.store')}}" method="post">
                        @csrf
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
                        <div class="d-grip gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection