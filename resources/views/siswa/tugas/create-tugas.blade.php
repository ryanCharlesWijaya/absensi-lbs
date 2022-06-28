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
                        <label for="file-input" class="form-label">Soal Tugas</label>
                        <div>
                            <b><a href="{{ $tugas->getFirstMedia()->getFullUrl() }}">{{ $tugas->getFirstMedia()->file_name }}</a></b>
                        </div>
                    </div>

                    @if (!$jawaban_tugas)
                        @if (!$tugas->has_expired)
                            <div class="mb-3">
                                <label for="file-input" class="form-label">File Jawaban</label>
                                <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="file-input">

                                @error('file')
                                    <div class="invalid-feedback">
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Pesan</label>
                                <textarea class="form-control @error("pesan") is-invalid @enderror" name="pesan" id="pesan-input" rows="3" required="require">{{ old("pesan") }}</textarea>

                                @error("pesan")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif
                    @else
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <th>Siswa</th>
                                    <th>Nilai</th>
                                    <th>Tanggal Pengerjaan</th>
                                    <th>Pesan</th>
                                    <th>File Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ([$jawaban_tugas] as $jawaban)
                                    <tr>
                                        <td>
                                            {{ $jawaban->siswa->nama }}
                                        </td>
                                        <td>{{ $jawaban->nilai ?? "belum dinilai" }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $jawaban->created_at)->format("Y-m-d") }}</td>
                                        <td>{{ substr($jawaban->pesan, 0, 100) }}</td>
                                        <td class="d-flex">
                                            <a href="{{ $jawaban->getFirstMedia()->getFullUrl() }}" target="__blank" class="btn btn-sm btn-primary me-2">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <div class="mb-3">
                        @if (!$tugas->has_expired)
                            <button class="btn btn-primary">Tambah</button>
                        @else
                            <span>Masa Pengumpulan Tugas Telah Berakhir</span>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection