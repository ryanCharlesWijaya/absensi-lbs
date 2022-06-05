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
                                <a class="nav-link" data-bs-toggle="tab" href="#quiz-tab">Quiz</a>
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
                                <label for="">Kurikulum</label>
                                <h3>{{ $pertemuan->kurikulum->id }}</h3>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="quiz-tab" role="tabpanel">
                            <a href="{{ route("guru.kurikulum.pertemuan.quiz.create", ["pertemuan_id" => $pertemuan->id]) }}" class="btn btn-dark">Create</a>
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
                                                    <a href="{{ route("guru.kurikulum.pertemuan.quiz.show", ["pertemuan_id" => $pertemuan->id, "quiz_id" => $quiz->id]) }}" class="btn btn-sm btn-danger">Detail</a>
                                                    <a href="{{ route("guru.kurikulum.pertemuan.quiz.edit", ["pertemuan_id" => $pertemuan->id, "quiz_id" => $quiz->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                                    <form action="{{ route("guru.kurikulum.pertemuan.quiz.delete", ["pertemuan_id" => $pertemuan->id, "quiz_id" => $quiz->id]) }}" class="d-inline-block" method="POST">
                                                        @csrf
                                                        <button class="btn btn-sm btn-secondary">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
