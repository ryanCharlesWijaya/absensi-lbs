@extends('layouts.print')

@section('content')
<div class="container">
    <div class="row p-8">
        <div class="col-12 mb-8">
            <div class="row">
                <div class="col-3">Mata Pelajaran:</div>
                <div class="col-9">Pendidikan Agama Buddha</div>
            </div>
            <div class="row">
                <div class="col-3">Kelas:</div>
                <div class="col-9">{{ $nilai_akhir->semester->kelas }}</div>
            </div>
            <div class="row">
                <div class="col-3">Semester:</div>
                <div class="col-9">{{ $nilai_akhir->semester->semester }}</div>
            </div>
            <div class="row">
                <div class="col-3">Tahun Ajaran:</div>
                <div class="col-9">{{ $nilai_akhir->semester->tahun_ajaran }}</div>
            </div>
        </div>
        <table class="col-12 table gs-7 gy-7 gx-7 border table-striped mb-8">
            <thead>
                <tr>
                    <th>
                        Nilai Praktek
                    </th>
                    <th>
                        Nilai Ulangan
                    </th>
                    <th>
                        Nilai Tugas
                    </th>
                    <th>
                        Nilai Akhir
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $nilai_akhir->nilai_praktek }}</td>
                    <td>{{ $nilai_akhir->nilai_ulangan }}</td>
                    <td>{{ $nilai_akhir->nilai_tugas }}</td>
                    <td>{{ $nilai_akhir->nilai_akhir }}</td>
                </tr>
            </tbody>
        </table>
        <div class="mt-10 pt-10 offset-9 col-3 text-center">
            Selat Panjang, {{ \Carbon\Carbon::now()->format("d M Y") }} <br>
            {{ $nilai_akhir->semester->sekolah->nama }} <br><br><br><br>
            <u>{{ $nilai_akhir->semester->guru->nama }}</u><br>
            Guru Agama
        </div>
    </div>
</div>
@endsection