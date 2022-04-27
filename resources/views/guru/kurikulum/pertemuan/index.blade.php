@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Daftar Pertemuan</h2>
                    <div class="card-toolbar">
                        {{-- <button class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah Kurikulum
                        </button> --}}
                        <a href="{{ route("guru.kurikulum.pertemuan.create") }}">
                            <button class="btn btn-sm btn-primary" >
                                <i class="fas fa-plus"></i> Tambah Pertemuan
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 gy-7">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <th>Id Kurikulum</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pertemuans as $pertemuan)
                                    <tr>
                                        <td>{{ $pertemuan->kurikulum_id}}</td>
                                        <td>{{ $pertemuan->tanggal }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route("guru.kurikulum.pertemuan.edit", ["pertemuan_id" => $pertemuan->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route("guru.kurikulum.pertemuan.delete", ["pertemuan_id" => $pertemuan->id]) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-danger">Delete</button>
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
