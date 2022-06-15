@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Quiz Detail</h2>
                    <div class="card-toolbar">
                        <a href="{{ route("guru.semester.pertemuan.quiz.edit", ["pertemuan_id" => $pertemuan->id, "quiz_id" => $quiz->id]) }}" class="btn btn-sm btn-primary" >
                            <i class="fas fa-plus"></i> Edit Quiz
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Tanggal Kadaluarsa</label>
                            <h3>{{ $quiz->tanggal_kadaluarsa }}</h3>
                        </div>
                        <div class="col-4">
                            <label for="">Semester</label>
                            <h3>{{ $pertemuan->semester->tahun_ajaran }}</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <th>kelas</th>
                                    <th>soal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quiz->soals as $soal)
                                    <tr>
                                        <td>{{ $soal->kelas }}</td>
                                        <td>{{ substr($soal->soal, 0, 80) }}...</td>
                                        <td>
                                            <a href="{{ route("guru.soal.show", ["soal_id" => $soal->id]) }}" class="btn btn-sm btn-danger">Detail</a>
                                            <a href="{{ route("guru.soal.edit", ["soal_id" => $soal->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route("guru.soal.delete", ["soal_id" => $soal->id]) }}" class="d-inline-block" method="POST">
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
@endsection