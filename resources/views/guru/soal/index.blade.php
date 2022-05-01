@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Daftar Soal</h2>
                    <div class="card-toolbar">
                        <a href="{{ route("guru.soal.create") }}">
                            <button class="btn btn-sm btn-primary" >
                                <i class="fas fa-plus"></i> Tambah Soal
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 gy-7">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <th>kelas</th>
                                    <th>soal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($soals as $soal)
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