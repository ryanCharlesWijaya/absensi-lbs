@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="py-8">
                        Detail Kurikulum
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label for="">Nama Kurikulum</label>
                            <h3>{{ $kurikulum->nama }}</h3>
                        </div>
                        <div class="col-12">
                            <label class="fw-bold" for="">Daftar Semesters</label>
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
                                    @foreach ($kurikulum->semesters as $semester)
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
    </div>
@endsection