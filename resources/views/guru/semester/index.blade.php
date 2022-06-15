@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Daftar Semester</h2>
                    <div class="card-toolbar">
                        <a href="{{ route("guru.semester.create") }}">
                            <button class="btn btn-sm btn-primary" >
                                <i class="fas fa-plus"></i> Tambah Semester
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <th>Tahun Ajaran</th>
                                    <th>Kelas</th>
                                    <th>Guru</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semesters as $semester)
                                    <tr>
                                        <td>{{ $semester->tahun_ajaran }}</td>
                                        <td>{{ $semester->kelas }}</td>
                                        <td>{{ $semester->guru ? $semester->guru->nama : "Kosong" }}</td>
                                        <td>
                                            <a href="{{ route("guru.semester.show", ["semester_id" => $semester->id]) }}" class="btn btn-sm btn-danger">Detail</a>
                                            <a href="{{ route("guru.semester.edit", ["semester_id" => $semester->id]) }}" class="btn btn-sm btn-info">Edit</a>
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