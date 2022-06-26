@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Daftar Pengumuman</h2>
                    <div class="card-toolbar">
                        <a href="{{ route("guru.pengumuman.create") }}">
                            <button class="btn btn-sm btn-primary" >
                                <i class="fas fa-plus"></i> Tambah Pengumuman
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengumumans as $pengumuman)
                                    <tr>
                                        <td>{{ $pengumuman->judul }}</td>
                                        <td>{{ $pengumuman->deskripsi }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route("guru.pengumuman.edit", ["pengumuman_id" => $pengumuman->id]) }}" class="btn btn-sm btn-info me-2">Edit</a>
                                            <form action="{{ route("guru.pengumuman.delete", ["pengumuman_id" => $pengumuman->id]) }}" method="POST">
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