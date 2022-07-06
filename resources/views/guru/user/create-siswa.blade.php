@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah User</h2>
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
                        type="number"
                        name="nomor_telepon"
                        title="Nomor Telepon"
                        id="nomor-telepon-input"
                        required="required"
                        maxchar="15"
                        info="minimal 9 karakter dan maksimal 15 karakter"
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
                        maxchar="60"
                        info="minimal 11 karakter. maksimal 60 karakter"
                    />

                    <x-text-input
                        type="password"
                        name="password"
                        title="Password"
                        id="password-input"
                        required="required"
                        maxchar="30"
                        info="minimal 8 karakter. maksimal 30 karakter"
                    />

                    <x-text-input
                        type="password"
                        name="password_confirmation"
                        title="Password Confirmation"
                        id="password-confirmation-input"
                        maxchar="30"
                        required="required"
                    />

                    <input type="hidden" name="role" value="siswa">

                    <div class="mb-3">
                        <label
                            class="form-label text-capitalize">
                            Nama Sekolah Asal
                        </label>
                        <input
                            type="text"
                            name="nama_sekolah"
                            class="form-control @error("nama_sekolah") is-invalid @enderror"
                            id="nama_sekolah_input"
                            list="sekolahs"
                            @if (old("nama_sekolah")) value="{{ old("nama_sekolah") }}" @endif
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
                    

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let role_input = ;
    </script>
@endsection