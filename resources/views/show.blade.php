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
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">{{ $stand->name}}</div>
                                <div class="card-body">{{ $stand->kelas}} {{ $stand->jurusan }}</div>
                                <div class="card-footer">
                                    <a href="{{ route('stand.index')}}" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection