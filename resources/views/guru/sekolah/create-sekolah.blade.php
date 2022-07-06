@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Sekolah</h2>
                </div>
                <form action="{{ route("guru.sekolah.store") }}" method="post" class="card-body">
                    @csrf
                    <x-text-input
                        type="text"
                        name="nama"
                        title="nama"
                        id="nama-input"
                        required="required"
                        />
                    
                    <x-text-input
                        name="deskripsi"
                        title="deskripsi"
                        id="deskripsi-input"
                        required="required"
                        />

                    <x-text-input
                        type="text"
                        name="alamat"
                        title="alamat"
                        id="alamat-input"
                        required="required"
                        />
                    
                    <x-text-input
                        type="text"
                        type="number"
                        name="nomor_telepon"
                        title="Nomor Telepon"
                        id="nomor-telepon-input"
                        required="required"
                        maxchar="15"
                        info="minimal 9 karakter dan maksimal 15 karakter"
                        />

                    <x-select-input
                        name="kategori"
                        title="Kategori Sekolah"
                        id="kategori-input">
                        <option>Pilih Kategori Sekolah</option>
                        <option value="sekolah_minggu" @if(old("kategori") == "sekolah_minggu") selected @endif>Sekolah Minggu</option>
                        <option value="sekolah_siswa" @if(old("kategori") == "sekolah_siswa") selected @endif>Sekolah Siswa</option>
                    </x-select-input>

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection