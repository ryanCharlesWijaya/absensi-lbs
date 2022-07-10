@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Edit Sekolah</h2>
                </div>
                <form action="{{ route("guru.sekolah.update", $sekolah->id) }}" method="post" class="card-body" enctype="multipart/form-data">
                    @csrf
                    <x-text-input
                        type="text"
                        name="nama"
                        title="nama"
                        id="nama-input"
                        :value="$sekolah->nama"
                        required="required"
                        />
                    
                    <x-text-input
                        name="deskripsi"
                        title="deskripsi"
                        id="deskripsi-input"
                        :value="$sekolah->deskripsi"
                        required="required"
                        />

                    <x-text-input
                        type="text"
                        name="alamat"
                        title="alamat"
                        id="alamat-input"
                        :value="$sekolah->alamat"
                        required="required"
                        />
                    
                    <x-text-input
                        type="text"
                        name="nomor_telepon"
                        title="nomor telepon"
                        id="nomor-telepon-input"
                        :value="$sekolah->nomor_telepon"
                        required="required"
                        maxchar="15"
                        info="minimal 9 karakter dan maksimal 15 karakter"
                        />

                    <x-select-input
                        name="kategori"
                        title="Kategori Sekolah"
                        id="kategori-input">
                        <option>Pilih Kategori Sekolah</option>
                        <option value="sekolah_minggu" 
                            @if(old("kategori"))
                                @if (old("kategori") == "sekolah_minggu")
                                    selected
                                @endif
                            @else
                                @if ($sekolah->kategori == "sekolah_minggu")
                                    selected
                                @endif
                            @endif>Sekolah Minggu</option>
                        <option value="sekolah_siswa" 
                            @if(old("kategori"))
                                @if (old("kategori") == "sekolah_siswa")
                                    selected
                                @endif
                            @else
                                @if ($sekolah->kategori == "sekolah_siswa")
                                    selected
                                @endif
                            @endif>Sekolah Siswa</option>
                    </x-select-input>

                    <div class="mb-3">
                        <label for="file-input" class="form-label">Gambar</label>
                        <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="file-input">

                        @error('file')
                            <div class="invalid-feedback">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection