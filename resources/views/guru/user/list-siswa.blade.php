@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Daftar Siswa</h2>
                    <div class="card-toolbar">
                        <a href="{{ route("guru.user.createSiswa") }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah Siswa
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Nomor Telepon</th>
                                    <th>Sekolah Asal</th>
                                    <th>Email</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $user)
                                    <tr>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->tanggal_lahir }}</td>
                                        <td>{{ $user->nomor_telepon }}</td>
                                        <td>{{ $user->sekolah ? $user->sekolah->nama : "" }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            @if (Auth::user()->is_admin)
                                                <a href="{{ route("guru.user.edit", ["user_id" => $user->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                            @endif
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