@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Pertemuan Detail</h2>
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#detail-tab">Detail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#absensi-tab">Absensi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#quiz-tab">Quiz</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tugas-tab">Tugas</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        {{-- Detail Tab --}}
                        <div class="tab-pane fade show active" id="detail-tab" role="tabpanel">
                            <div class="mb-4">
                                <label for="">Judul</label>
                                <h3>{{ $pertemuan->judul }}</h3>
                            </div>
                            <div class="mb-4">
                                <label for="">Deskripsi</label>
                                <h3>{{ $pertemuan->deskripsi }}</h3>
                            </div>
                            <div class="mb-4">
                                <label for="">Tanggal</label>
                                <h3>{{ $pertemuan->tanggal }}</h3>
                            </div>
                            <div class="mb-4">
                                <label for="">Semester</label>
                                <h3>{{ $pertemuan->semester->id }}</h3>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="absensi-tab" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-rounded table-striped border gy-7 gs-7">
                                    <thead>
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <th>Siswa</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pertemuan->absensi as $absensi)
                                            <tr>
                                                <td>
                                                    {{ $absensi->user->nama }}
                                                </td>
                                                <td>
                                                    <span class="badge badge-primary">{{ $absensi->status }}</span>
                                                </td>
                                                <td>
                                                    <form action="{{ route("guru.semester.pertemuan.absensi.updateStatus", ["pertemuan_id" => $pertemuan->id, "absensi_id" => $absensi->id, "status" => "hadir"]) }}" class="d-inline-block" method="POST">
                                                        @csrf
                                                        <button class="btn btn-sm btn-secondary">Update Ke Hadir</button>
                                                    </form>
                                                    <form action="{{ route("guru.semester.pertemuan.absensi.updateStatus", ["pertemuan_id" => $pertemuan->id, "absensi_id" => $absensi->id, "status" => "tidak hadir"]) }}" class="d-inline-block" method="POST">
                                                        @csrf
                                                        <button class="btn btn-sm btn-secondary">Update Ke Tidak Hadir</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="quiz-tab" role="tabpanel">
                            @if (!$pertemuan->quiz)
                                <a href="{{ route("guru.semester.pertemuan.quiz.create", ["pertemuan_id" => $pertemuan->id]) }}" class="btn btn-dark mb-4">Create</a>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-rounded table-striped border gy-7 gs-7">
                                    <thead>
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <th>Tahun Ajaran</th>
                                            <th>Tanggal Kadaluarsa</th>
                                            <th>Jumlah Soal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quizzes as $quiz)
                                            <tr>
                                                <td>
                                                    {{ $quiz->id }}
                                                </td>
                                                <td>{{ $quiz->tanggal_kadaluarsa }}</td>
                                                <td>{{ $quiz->soals()->count() }}</td>
                                                <td>
                                                    <a href="{{ route("guru.semester.pertemuan.quiz.show", ["pertemuan_id" => $pertemuan->id, "quiz_id" => $quiz->id]) }}" class="btn btn-sm btn-danger">Detail</a>
                                                    <a href="{{ route("guru.semester.pertemuan.quiz.edit", ["pertemuan_id" => $pertemuan->id, "quiz_id" => $quiz->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                                    <form action="{{ route("guru.semester.pertemuan.quiz.delete", ["pertemuan_id" => $pertemuan->id, "quiz_id" => $quiz->id]) }}" class="d-inline-block" method="POST">
                                                        @csrf
                                                        <button class="btn btn-sm btn-secondary">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if (isset($quizzes[0]))
                                    <table class="table table-rounded table-striped border gy-7 gs-7">
                                        <thead>
                                            <tr class="fw-bolder fs-6 text-gray-800">
                                                <th>Siswa</th>
                                                <th>Nilai</th>
                                                <th>Tanggal Kumpul</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($quizzes[0]->hasil_quizzes as $hasil_quiz)
                                                <tr>
                                                    <td>
                                                        {{ $hasil_quiz->user->nama }}
                                                    </td>
                                                    <td>{{ $hasil_quiz->nilai ?? "belum dinilai" }}</td>
                                                    <td>{{ \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $hasil_quiz->created_at)->format("Y-m-d") }}</td>
                                                    <td>
                                                        <a href="{{ route("guru.semester.pertemuan.hasilQuiz.reviewQuiz", ["pertemuan_id" => $pertemuan->id, "hasil_quiz_id" => $hasil_quiz->id]) }}" class="btn btn-sm btn-primary me-2">
                                                            Review Quiz
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tugas-tab" role="tabpanel">
                            @if (!$pertemuan->tugas)
                                <a href="{{ route("guru.semester.pertemuan.tugas.create", ["pertemuan_id" => $pertemuan->id]) }}" class="btn btn-dark mb-4">Create</a>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-rounded table-striped border gy-7 gs-7">
                                    <thead>
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal Kadaluarsa</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tugases as $tugas)
                                            <tr>
                                                <td>
                                                    {{ $tugas->judul }}
                                                </td>
                                                <td>{{ $tugas->deskripsi }}</td>
                                                <td>{{ $tugas->tanggal_kadaluarsa }}</td>
                                                <td>
                                                    <a href="{{ route("guru.semester.pertemuan.tugas.edit", ["pertemuan_id" => $pertemuan->id, "tugas_id" => $tugas->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                                    <form action="{{ route("guru.semester.pertemuan.tugas.delete", ["pertemuan_id" => $pertemuan->id, "tugas_id" => $tugas->id]) }}" class="d-inline-block" method="POST">
                                                        @csrf
                                                        <button class="btn btn-sm btn-secondary">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if (isset($tugases[0]))
                                    <table class="table table-rounded table-striped border gy-7 gs-7">
                                        <thead>
                                            <tr class="fw-bolder fs-6 text-gray-800">
                                                <th>Siswa</th>
                                                <th>Nilai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tugases[0]->jawaban as $jawaban)
                                                <tr>
                                                    <td>
                                                        {{ $jawaban->siswa->nama }}
                                                    </td>
                                                    <td>{{ $jawaban->nilai ?? "belum dinilai" }}</td>
                                                    <td>{{ \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $jawaban->created_at)->format("Y-m-d") }}</td>
                                                    <td>
                                                        <a href="{{ route("guru.semester.pertemuan.jawabanTugas.showNilai", ["pertemuan_id" => $pertemuan->id, "jawaban_tugas_id" => $jawaban->id]) }}" class="btn btn-sm btn-danger">Nilai Tugas</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
