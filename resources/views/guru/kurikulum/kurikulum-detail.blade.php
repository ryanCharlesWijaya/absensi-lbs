@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card ">
                <div class="card-header card-header-stretch">
                    <h2 class="py-8">
                        Detail Kurikulum
                    </h2>
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#detail-tab">Detail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#resource-tab">Resource</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#pertemuan-tab">Pertemuan</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        {{-- Detail Tab --}}
                        <div class="tab-pane fade show active" id="detail-tab" role="tabpanel">
                            <div class="mb-4">
                                <label for="">Kelas</label>
                                <div>{{ $kurikulum->kelas }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="">Tahun Ajaran</label>
                                <div>{{ $kurikulum->tahun_ajaran }}</div>
                            </div>
                        </div>
                        
                        {{-- Resource Tab --}}
                        <div class="tab-pane fade" id="resource-tab" role="tabpanel">
                            <a href="{{ route("guru.kurikulum.resources.create", ["kurikulum_id" => $kurikulum->id]) }}" class="btn btn-dark">Create</a>
                            <table class="table table-row-dashed table-row-gray-300 gy-7">
                                <thead>
                                    <tr class="fw-bolder fs-6 text-gray-800">
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kurikulum->getMedia() as $media)
                                        <tr>
                                            <td>{{ $media->name }}</td>
                                            <td class="d-flex">
                                                <a href="{{ route("guru.kurikulum.resources.download", ["kurikulum_id" => $kurikulum->id, "media_id" => $media->id]) }}" class="btn btn-sm btn-primary me-2">Download</a>
                                                <form action="{{ route("guru.kurikulum.resources.delete", ["kurikulum_id" => $kurikulum->id, "media_id" => $media->id]) }}" method="POST">
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

                        {{-- Pertemuan Tab --}}
                        <div class="tab-pane fade" id="pertemuan-tab" role="tabpanel">
                            <a href="{{ route("guru.kurikulum.pertemuan.create", ["kurikulum_id" => $kurikulum->id]) }}" class="btn btn-dark">Create</a>
                            <table class="table table-row-dashed table-row-gray-300 gy-7">
                                <thead>
                                    <tr class="fw-bolder fs-6 text-gray-800">
                                        <th>Nomor</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($pertemuans as $key => $pertemuan)
                                        <tr>
                                            <td>{{ $key + 1}}</td>
                                            <td>{{ $pertemuan->judul }}</td>
                                            <td>{{ $pertemuan->deskripsi }}</td>
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
    </div>
@endsection