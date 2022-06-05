@extends('layouts.app')

@push('head')
    <link href="{{ asset("assets/plugins/global/plugins.bundle.css") }}" rel="stylesheet" type="text/css"/>
@endpush

@push('scripts')
    <script src="{{ asset("assets/plugins/global/plugins.bundle.js") }}"></script>
@endpush

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Tugas</h2>
                </div>
                <form action="{{ route("guru.kurikulum.pertemuan.tugas.update", ["pertemuan_id" => $pertemuan->id, "tugas_id" => $tugas->id]) }}" method="post" class="card-body" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pertemuan_id" value="{{ $pertemuan->id }}">

                    <x-text-input
                        type="text"
                        name="judul"
                        title="Judul Pertemuan"
                        id="judul-input"
                        required="required"
                        value="{{ $tugas->judul }}"
                        />

                    <div class="mb-3">
                        <label for="" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error("deskripsi") is-invalid @enderror" name="deskripsi" id="deskripsi-input" rows="3" required="require">{{ old("deskripsi") ?? $tugas->deskripsi }}</textarea>

                        @error("deskripsi")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <x-text-input
                        type="date"
                        name="tanggal_kadaluarsa"
                        title="tanggal kadaluarsa"
                        id="tanggal-kadaluarsa-input"
                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                        required="required"
                        value="{{ old('tanggal_kadaluarsa') ?? \Carbon\Carbon::createFromFormat('Y-m-d', $tugas->tanggal_kadaluarsa)->format('Y-m-d') }}"
                        />
                    
                    <div class="mb-3">
                        <label for="file-input" class="form-label">Default file input example</label>
                        <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="file-input">

                        @error('file')
                            <div class="invalid-feedback">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection