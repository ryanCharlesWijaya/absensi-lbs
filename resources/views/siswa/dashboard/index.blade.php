@extends('layouts.siswa')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card card-xl-stretch-50 mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <!--begin::Stats-->
                    <div class="flex-grow-1 card-p pb-0">
                        <div class="d-flex flex-stack flex-wrap">
                            <div class="me-2">
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Hasil-hasil Tugas</a>
                                <div class="text-muted fs-7 fw-bold">Hasil tugas yang telah dikerjakan siswa</div>
                            </div>
                            <div class="fw-bolder fs-3 text-primary">{{$jawaban_tugases->count() }} Tugas</div>
                        </div>
                    </div>
                    <!--end::Stats-->
                    <div class="w-100">
                        <div class="w-100 mt-2 table table-rounded table-striped gy-7 gs-7 m-8 col-12">
                            <table class="mt-2 table table-rounded table-striped gy-7 gs-7">
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
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-12">
            <div class="card card-xl-stretch-50 mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <!--begin::Stats-->
                    <div class="flex-grow-1 card-p pb-0">
                        <div class="d-flex flex-stack flex-wrap">
                            <div class="me-2">
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Hasil-hasil Quiz</a>
                                <div class="text-muted fs-7 fw-bold">Hasil quiz yang telah dikerjakan siswa</div>
                            </div>
                            <div class="fw-bolder fs-3 text-primary">{{ $hasil_quizzes->count() }} Quiz</div>
                        </div>
                    </div>
                    <!--end::Stats-->
                    <div class="w-100">
                        <table class="w-100 mt-2 table table-rounded table-striped gy-7 gs-7 m-8 col-12">
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
                                            {{ $hasil->user->nama }}
                                        </td>
                                        <td>{{ $hasil->nilai ?? "belum dinilai" }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $hasil->created_at)->format("Y-m-d") }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-6">
            <div class="card card-xl-stretch-50 mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <!--begin::Stats-->
                    <div class="flex-grow-1 card-p pb-0">
                        <div class="d-flex flex-stack flex-wrap">
                            <div class="me-2">
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Pertemuan Bolos</a>
                                <div class="text-muted fs-7 fw-bold">Jumlah Pertemuan yang Bolos/ Tidak Absen</div>
                            </div>
                            <div class="fw-bolder fs-3 text-primary">{{ \App\Models\Absensi::where("user_id", Auth::id())->whereHas("pertemuan", function ($query) {
                                return $query->where("tanggal", "<", \Carbon\Carbon::now()->format("Y-m-d"));
                            }, ">", 0)->where("status", "tidak hadir")->count() }} Kali</div>
                        </div>
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-6">
            <div class="card card-xl-stretch-50 mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <!--begin::Stats-->
                    <div class="flex-grow-1 card-p pb-0">
                        <div class="d-flex flex-stack flex-wrap">
                            <div class="me-2">
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Nilai Rata" Siswa</a>
                                <div class="text-muted fs-7 fw-bold">Rata" Nilai Siswa dihitung dari nilai akhir semester yang diikuti</div>
                            </div>
                            @php
                                $nilai_akhirs = \App\Models\NilaiAkhir::where("siswa_id", Auth::id())->sum("nilai_akhir");
                                $jumlah_semester = \App\Models\NilaiAkhir::where("siswa_id", Auth::id())->count();

                            @endphp
                            <div class="fw-bolder fs-3 text-primary">{{ $jumlah_semester ? $nilai_akhirs / $jumlah_semester : "-" }}</div>
                        </div>
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        
    </div>
@endsection
