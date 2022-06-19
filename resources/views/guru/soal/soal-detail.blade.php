@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Detail Soal</h2>
                    <div class="card-toolbar">
                        <a href="{{ route("guru.soal.edit", ["soal_id" => $soal->id]) }}" class="btn btn-sm btn-primary" >
                            <i class="fas fa-pen"></i> Edit Soal
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="">Soal:</label>
                        <h1>{{ $soal->soal }}</h1>
                    </div>
                    <div class="mb-4">
                        <label for="">Kelas:</label>
                        <h1>{{ $soal->kelas }}</h1>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="">Jawaban:</label>
                        <div class="card shadow">
                            <div class="card-body @if($soal->jawaban == 'a') bg-success text-white @endif">
                                <h5 class="card-title @if($soal->jawaban == 'a') text-white @endif">Pilihan A:</h5>
                                <p class="card-text">{{ $soal->pilihan_a }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="card shadow">
                            <div class="card-body @if($soal->jawaban == 'b') bg-success text-white @endif">
                                <h5 class="card-title @if($soal->jawaban == 'b') text-white @endif">Pilihan B:</h5>
                                <p class="card-text">{{ $soal->pilihan_b }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="card shadow">
                            <div class="card-body @if($soal->jawaban == 'c') bg-success text-white @endif">
                                <h5 class="card-title @if($soal->jawaban == 'c') text-white @endif">Pilihan C:</h5>
                                <p class="card-text">{{ $soal->pilihan_c }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="card shadow">
                            <div class="card-body @if($soal->jawaban == 'd') bg-success text-white @endif">
                                <h5 class="card-title @if($soal->jawaban == 'd') text-white @endif">Pilihan D:</h5>
                                <p class="card-text">{{ $soal->pilihan_d }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection