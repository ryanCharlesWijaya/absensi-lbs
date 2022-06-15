@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Nilai Jawaban Tugas</h2>
                    <div class="card-toolbar">
                    </div>
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
                            @if ($jawaban_tugas->getFirstMedia())
                                <tr>
                                    <td>{{ $jawaban_tugas->getFirstMedia()->name }}</td>
                                    <td class="d-flex">
                                        <a href="{{ $jawaban_tugas->getFirstMedia()->getFullUrl() }}" target="__blank" class="btn btn-sm btn-primary me-2">View</a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <form method="POST" action="{{ route("guru.semester.pertemuan.jawabanTugas.nilai", ["pertemuan_id" => $jawaban_tugas->tugas->pertemuan->id, "jawaban_tugas_id" => $jawaban_tugas->id]) }}" class="row">
                        @csrf
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label>Nilai</label>
                                <input class="form-control" type="number" min="0" max="100" name="nilai" placeholder="Nilai">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection