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
                    <input type="hidden" name="role" value="{{ $user->role }}">

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
                        type="number"
                        name="nomor_telepon"
                        title="Nomor Telepon"
                        id="nomor-telepon-input"
                        required="required"
                        info="minimal 9 karakter dan maksimal 15 karakter"



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

                    @if ($user->role == "siswa")
                        <div class="mb-3">
                            <label
                                class="form-label text-capitalize">
                                Nama Sekolah
                            </label>
                            <input
                                type="text"
                                name="nama_sekolah"
                                class="form-control @error("nama_sekolah") is-invalid @enderror"
                                id="nama_sekolah_input"
                                list="sekolahs"
                                value="{{ old("nama_sekolah") ?? $user->sekolah ? $user->sekolah->nama : "" }}"
                                required>

                            @error("nama_sekolah")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <datalist id="sekolahs">
                            @foreach (\App\Models\Sekolah::where("kategori", "sekolah_siswa")->get() as $sekolah)
                                <option value="{{ $sekolah->nama }}">{{ $sekolah->nama }}</option>
                            @endforeach
                        </datalist>
                    @endif

                    <div class="mb-3">
                        <button class="btn btn-primary">Edit</button>
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
                        info="minimal 8 karakter. maksimal 30 karakter"
                    />

                    <x-text-input
                        type="password"
                        name="password_confirmation"
                        title="Password Confirmation"
                        id="password-confirmation-input"
                        required="required"
                    />

                    <div class="mb-3">
                        <button class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection