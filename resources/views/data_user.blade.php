@extends('layouts.admin')

@section('admin-title')
Data User
@endsection()
@section('admin-content')
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UpdateUser-{{$user->id}}">
                                Edit
                                </button>
                
                                    <!-- Modal -->
                                    <form action="{{ route('UpdateUser',['id'=>$user->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="modal fade" id="UpdateUser-{{$user->id}}" tabindex="-1" aria-labelledby="UpdateUserLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name">Nama</label>
                                                        <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="username">Username</label>
                                                        <input type="text" class="form-control" name="username" value="{{$user->username}}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="confirm_password">Konfirm Password</label>
                                                        <input type="password" class="form-control" name="confirm_password" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="role">Role</label>
                                                        <select name="role" id="" class="form-select" required>
                                                            <option value="">-- Pilih Opsi --</option>
                                                            <option value="{{ $user->role }}"{{ $user->role == $user->role ? 'selected':'' }}>{{ $user->role }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-{{$user->id}}">
                        delete
                        </button>
                        <!-- Modal -->
                    <div class="modal fade" id="delete-{{$user->id}}" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteLabel">Delete</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda Yakin Akan Menghapus {{ $user -> username }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('data_user.destroy',['id'=>$user->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-success">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection