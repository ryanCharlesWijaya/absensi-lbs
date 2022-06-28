@extends('layouts.app')

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
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Statistik Pendaftaran Siswa</a>
                                <div class="text-muted fs-7 fw-bold">Melihat jumlah pendaftaran siswa dari bulan" lalu</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Stats-->
                    <div>
                        <div id="kt_apexcharts_3" style="height: 350px;"></div>
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
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Jumlah Siswa</a>
                                <div class="text-muted fs-7 fw-bold">Jumlah Siswa Yang Terdaftar di Sistem</div>
                            </div>
                            <div class="fw-bolder fs-3 text-primary">{{ \App\Models\User::role("siswa")->count() }} Orang</div>
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
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Jumlah Guru</a>
                                <div class="text-muted fs-7 fw-bold">Jumlah Guru Yang Mengajar</div>
                            </div>
                            <div class="fw-bolder fs-3 text-primary">{{ \App\Models\User::role("admin")->count() }} Orang</div>
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
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Jumlah Sekolah Siswa</a>
                                <div class="text-muted fs-7 fw-bold">Jumlah Sekolah Siswa Yang Terdaftar di Sistem</div>
                            </div>
                            <div class="fw-bolder fs-3 text-primary">{{ \App\Models\Sekolah::where("kategori", "sekolah_siswa")->count() }} Sekolah</div>
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
                                <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Jumlah Sekolah Minggu</a>
                                <div class="text-muted fs-7 fw-bold">Jumlah Sekolah Minggu Yang Tersedia</div>
                            </div>
                            <div class="fw-bolder fs-3 text-primary">{{ \App\Models\Sekolah::where("kategori", "sekolah_minggu")->count() }} Sekolah</div>
                        </div>
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/> --}}
    <script src="{{ asset("assets/plugins/global/plugins.bundle.js") }}"></script>
    @php
        $current_year = \Carbon\Carbon::now()->format("Y");

        $jan = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-01-00 00:00:00")->where("created_at", "<", "{$current_year}-01-31 23:59:59")->count();
        $feb = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-02-00 00:00:00")->where("created_at", "<", "{$current_year}-02-31 23:59:59")->count();
        $mar = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-03-00 00:00:00")->where("created_at", "<", "{$current_year}-03-31 23:59:59")->count();
        $apr = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-04-00 00:00:00")->where("created_at", "<", "{$current_year}-04-31 23:59:59")->count();
        $may = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-05-00 00:00:00")->where("created_at", "<", "{$current_year}-05-31 23:59:59")->count();
        $jun = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-06-00 00:00:00")->where("created_at", "<", "{$current_year}-06-31 23:59:59")->count();
        $jul = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-07-00 00:00:00")->where("created_at", "<", "{$current_year}-07-31 23:59:59")->count();
        $aug = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-08-00 00:00:00")->where("created_at", "<", "{$current_year}-08-31 23:59:59")->count();
        $sep = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-09-00 00:00:00")->where("created_at", "<", "{$current_year}-09-31 23:59:59")->count();
        $oct = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-10-00 00:00:00")->where("created_at", "<", "{$current_year}-10-31 23:59:59")->count();
        $nov = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-11-00 00:00:00")->where("created_at", "<", "{$current_year}-11-31 23:59:59")->count();
        $dec = \App\Models\User::role("siswa")->where("created_at", ">", "{$current_year}-12-00 00:00:00")->where("created_at", "<", "{$current_year}-12-31 23:59:59")->count();
    @endphp
    <script>
        var element = document.getElementById('kt_apexcharts_3');

        var height = parseInt("350px");
        var labelColor = "#aaaaaa";
        var borderColor = "#cccccc";
        var baseColor = "#009EF7";
        var lightColor = "#2ba6ec5d";

        var options = {
            series: [{
                name: 'Net Profit',
                data: [{{ $jan }}, {{ $feb }}, {{ $mar }}, {{ $apr }}, {{ $may }}, {{ $jun }}, {{ $jul }}, {{ $aug }}, {{ $sep }}, {{ $oct }}, {{ $nov }}, {{ $dec }}]
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {

            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [baseColor]
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug',  'Oct', 'Nov', 'Dec'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    position: 'front',
                    stroke: {
                        color: baseColor,
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return val + ' orang'
                    }
                }
            },
            colors: [lightColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                strokeColor: baseColor,
                strokeWidth: 3
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    </script>
@endpush