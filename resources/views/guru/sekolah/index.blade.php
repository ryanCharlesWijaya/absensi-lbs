@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Daftar Sekolah</h2>
                    <div class="card-toolbar">
                        <a href="{{ route("guru.sekolah.create") }}">
                            <button class="btn btn-sm btn-primary" >
                                <i class="fas fa-plus"></i> Tambah Sekolah
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sekolahs as $sekolah)
                                    <tr>
                                        <td>{{ $sekolah->nama }}</td>
                                        <td>{{ substr($sekolah->deskripsi, 0, 100) }}</td>
                                        <td>{{ $sekolah->nomor_telepon }}</td>
                                        <td>
                                            <a href="{{ route("guru.sekolah.edit", ["sekolah_id" => $sekolah->id]) }}" class="btn btn-sm btn-info">Edit</a>
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