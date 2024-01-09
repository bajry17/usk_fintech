@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">Edit Stand</div>
                        <div class="col"><a class="btn btn-primary" href="{{ route('stand.index') }}">Kembali</a></div>
                    </div>
                </div>
                <div class="card-body">
                        <form action="{{ route('stand.update',['stand'=>$edits->id]) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="name">Nama Stand</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $edits->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control">
                                    <option value=""><-- Pilih Opsi --></option>
                                    @foreach(['X','XI','XII'] as $kelas)
                                    <option value="{{ $kelas }}"{{$edits->kelas == $kelas ? 'selected':''}}>{{ $kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jurusan">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-control">
                                    <option value=""><-- Pilih Opsi --></option>
                                    @foreach(['RPL','AKL','OTKP', 'BDP'] as $jurusan)
                                    <option value="{{ $jurusan }}"{{$edits->jurusan == $jurusan ? 'selected':''}}>{{ $jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary text-end" type="submit">Submit</button>
                        </form>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection