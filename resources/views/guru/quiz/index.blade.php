@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Daftar Quiz</h2>
                    <div class="card-toolbar">
                        {{-- <button class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah Kurikulum
                        </button> --}}
                        <a href="{{ route("guru.quiz.create") }}">
                            <button class="btn btn-sm btn-primary" >
                                <i class="fas fa-plus"></i> Tambah Quiz
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 gy-7">
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
                                            {{-- {{ $quiz->pertemuan->kurikulum->tahun_ajaran }} --}}
                                            {{ $quiz->id }}
                                        </td>
                                        <td>{{ $quiz->tanggal_kadaluarsa }}</td>
                                        <td>{{ $quiz->soals()->count() }}</td>
                                        <td>
                                            <a href="{{ route("guru.quiz.show", ["quiz_id" => $quiz->id]) }}" class="btn btn-sm btn-danger">Detail</a>
                                            <a href="{{ route("guru.quiz.edit", ["quiz_id" => $quiz->id]) }}" class="btn btn-sm btn-info">Edit</a>
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
@endsection