@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 text-center">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">Daftar Stand</div>
                        <div class="col"><a class="btn btn-primary" href="{{ route('stand.create') }}">Tambah</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($stands as $stand)
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">{{ $stand->name}}</div>
                                <div class="card-body">{{ $stand->kelas}} {{ $stand->jurusan }}</div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('stand.show',$stand->id) }}" class="btn btn-warning">Show</a>
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('stand.edit',$stand->id) }}" class="btn btn-warning">Edit</a>
                                        </div>
                                        <div class="col">
                                            <form action="{{ route('stand.destroy',$stand->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection