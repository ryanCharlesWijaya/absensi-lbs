@extends('layouts.siswa')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Daftar Resource Siswa</h2>
                </div>
                <div class="card-body">
                    <table class="table table-rounded table-striped border gy-7 gs-7">
                        <thead>
                            <tr class="fw-bolder fs-6 text-gray-800">
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resources as $resource)
                                <tr>
                                    <td>{{ $resource->getFirstMedia()->name }}</td>
                                    <td class="d-flex">
                                        <a href="{{ $resource->getFirstMedia()->getFullUrl() }}" target="__blank" class="btn btn-sm btn-primary me-2">View</a>
                                        <a href="{{ route("guru.resourceSiswa.download", [ "resource_siswa_id" => $resource->id]) }}" class="btn btn-sm btn-info me-2">Download</a>
                                        <form action="{{ route("guru.resourceSiswa.delete", [ "resource_siswa_id" => $resource->id]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-danger">
                                                Delete
                                            </button>
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
@endsection