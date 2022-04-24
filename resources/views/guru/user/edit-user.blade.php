@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="py-8">Edit User Detail</h2>
                </div>
                <form action="{{ route("guru.user.updateDetail", ["user_id" => $user->id]) }}" method="post" class="card-body">
                    @csrf
                    <x-text-input
                        type="text"
                        name="nama"
                        title="nama"
                        id="nama-input"
                        required="required"
                        value="{{ $user->nama }}"
                    />

                    <x-text-input
                        name="tahun_lahir"
                        title="Tahun Lahir"
                        id="tahun-lahir-input"
                        info="Contoh 13/01/2000"
                        required="required"
                        value="{{ $user->tanggal_lahir }}"
                    />

                    <x-text-input
                        type="text"
                        name="nomor_telepon"
                        title="Nomor Telepon"
                        id="nomor-telepon-input"
                        required="required"
                        value="{{ $user->nomor_telepon }}"
                    />

                    <x-text-input
                        name="alamat"
                        title="Alamat"
                        id="alamat-input"
                        value="{{ $user->alamat }}"
                    />
                    
                    <x-text-input
                        name="email"
                        title="Email"
                        id="email-input"
                        value="{{ $user->email }}"
                    />

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Edit User Password</h2>
                </div>
                <form action="{{ route("guru.user.updatePassword", ["user_id" => $user->id]) }}" method="post" class="card-body">
                    @csrf
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

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection