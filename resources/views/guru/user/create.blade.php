@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Guru</h2>
                </div>
                <form action="{{ route("guru.user.store") }}" method="post" class="card-body">
                    @csrf
                    
                    <x-text-input
                        type="text"
                        name="nama"
                        title="nama"
                        id="nama-input"
                        required="required"
                    />

                    <x-text-input
                        type="date"
                        name="tanggal_lahir"
                        title="Tanggal Lahir"
                        id="tanggal-lahir-input"
                        info="Contoh 13/01/2000"
                        required="required"
                    />

                    <x-text-input
                        type="number"
                        name="nomor_telepon"
                        title="Nomor Telepon"
                        id="nomor-telepon-input"
                        required="required"
                    />

                    <x-text-input
                        name="alamat"
                        title="Alamat"
                        id="alamat-input"
                        required="required"
                    />
                    
                    <x-text-input
                        name="email"
                        title="Email"
                        id="email-input"
                        required="required"
                    />

                    <x-text-input
                        type="password"
                        name="password"
                        title="Password"
                        id="password-input"
                        required="required"
                    />

                    <x-text-input
                        type="password"
                        name="password_confirmation"
                        title="Password Confirmation"
                        id="password-confirmation-input"
                        required="required"
                    />

                    <input type="hidden" name="role" value="admin">

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection