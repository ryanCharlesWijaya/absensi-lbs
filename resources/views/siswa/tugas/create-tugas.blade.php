@extends('layouts.siswa')

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
                    <h2 class="py-8">Kumpul Tugas</h2>
                </div>
                <form action="{{ route("siswa.pertemuan.tugas.upload", ["pertemuan_id" => $pertemuan->id, "tugas_id" => $tugas->id]) }}" method="post" class="card-body" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">

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
                        <label for="" class="form-label">pesan</label>
                        <textarea class="form-control @error("pesan") is-invalid @enderror" name="pesan" id="pesan-input" rows="3" required="require">{{ old("pesan") }}</textarea>

                        @error("pesan")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
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