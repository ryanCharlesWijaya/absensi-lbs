@extends('layouts.siswa')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="py-8">
                        Pertemuan
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-rounded table-striped border gy-7 gs-7">
                        <thead>
                            <tr class="fw-bolder fs-6 text-gray-800">
                                <th>Nomor</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($pertemuans as $key => $pertemuan)
                                <tr>
                                    <td>{{ $key + 1}}</td>
                                    <td>
                                        {{ $pertemuan->judul }}
                                        @if ($pertemuan->has_absen)
                                            <span class="badge badge-light-success">Sudah Absen</span>
                                        @else
                                            <span class="badge badge-light">Belum Absen</span>
                                        @endif
                                    </td>
                                    <td>{{ $pertemuan->deskripsi }}</td>
                                    <td>{{ $pertemuan->tanggal }}</td>
                                    <td class="d-flex">
                                        @if (!$pertemuan->has_absen && $pertemuan->can_absen)
                                            <form action="{{ route("siswa.pertemuan.absensi.absen", ["pertemuan_id" => $pertemuan->id, "absensi_id" => $pertemuan->absensi()->where("user_id", Auth::id())->first()->id]) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-info me-2">Absen!</button>
                                            </form>
                                        @endif
                                        @if ($pertemuan->tugas && !$pertemuan->has_kumpul_tugas)
                                            <a href="{{ route("siswa.pertemuan.tugas.create", ["pertemuan_id" => $pertemuan->id, "tugas_id" => $pertemuan->tugas->id]) }}" class="btn btn-sm btn-primary me-2">
                                                Kumpul Tugas
                                            </a>
                                        @endif
                                        @if ($pertemuan->quiz)
                                            @if (!$pertemuan->quiz->has_expired && !$pertemuan->has_kerjain_quiz)
                                                <a href="{{ route("siswa.pertemuan.quiz.kerjakanQuiz", ["pertemuan_id" => $pertemuan->id, "quiz_id" => $pertemuan->quiz->id]) }}" class="btn btn-sm btn-primary me-2">
                                                    Kerjain Quiz
                                                </a>
                                            @elseif ($pertemuan->quiz->has_expired && $pertemuan->has_kerjain_quiz)
                                                <a href="{{ route("siswa.pertemuan.quiz.reviewQuiz", ["pertemuan_id" => $pertemuan->id, "quiz_id" => $pertemuan->quiz->id]) }}" class="btn btn-sm btn-primary me-2">
                                                    Review Quiz
                                                </a>
                                            @endif
                                        @endif
                                        @if ($pertemuan->getFirstMedia())
                                            <form action="{{ $pertemuan->getFirstMedia()->getFullUrl() }}" method="GET">
                                                @csrf
                                                <button class="btn btn-sm btn-danger">Tampilkan Resource</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>    
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection