@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Beri Nilai</h2>
                    <div class="card-toolbar">
                        <span class="badge badge-light-primary">
                            {{ $absensi_count }} Absen
                        </span>
                    </div>
                </div>
                <form action="{{ route("guru.semester.nilaiAkhir.store", ["semester_id" => $semester->id, "siswa_id" => $siswa->id]) }}" method="post" class="card-body" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="semester_id" value="{{ $semester->id }}">
                    <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

                    <div class="row mb-5">
                        <label for=""><b>Nilai Tugas</b></label>
                        <table class="mt-2 table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <th>Siswa</th>
                                    <th>Nilai</th>
                                    <th>Tanggal Kumpul</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jawaban_tugases as $jawaban)
                                    <tr>
                                        <td>
                                            {{ $jawaban->siswa->nama }}
                                        </td>
                                        <td>{{ $jawaban->nilai ?? "belum dinilai" }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $jawaban->created_at)->format("Y-m-d") }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row mb-5">
                        <label for=""><b>Nilai Quiz</b></label>
                        <table class="mt-2 table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800">
                                    <th>Siswa</th>
                                    <th>Nilai</th>
                                    <th>Tanggal Kumpul</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasil_quizzes as $hasil)
                                    <tr>
                                        <td>
                                            {{ $jawaban->user->nama }}
                                        </td>
                                        <td>{{ $jawaban->nilai ?? "belum dinilai" }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $jawaban->created_at)->format("Y-m-d") }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <x-text-input
                        type="text"
                        name="nilai"
                        title="Nilai Pertemuan"
                        id="nilai-input"
                        required="required"
                        />

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
