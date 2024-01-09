@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row justify-content-center">
            @if(Auth::user()->role == 'admin')
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        @include('components.sidebar_admin')
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col d-flex justify-content-start align-items-center">   
                                @yield('admin-title')
                            </div>
                            <div class="col d-flex justify-content-end align-items-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddUser">
                                Tambah
                                </button>
                
                                    <!-- Modal -->
                                    <form action="{{ route('AddUser') }}" method="post">
                                        @csrf
                                        <div class="modal fade" id="AddUser" tabindex="-1" aria-labelledby="AddUserLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name">Nama</label>
                                                        <input type="text" class="form-control" name="name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="username">Username</label>
                                                        <input type="text" class="form-control" name="username" required>
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
                                                            <option value="siswa">Siswa</option>
                                                            <option value="bank">Bank</option>
                                                            <option value="Kantin">Kantin</option>
                                                            <option value="admin">Admin</option>
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
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @yield('admin-content')
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endsection