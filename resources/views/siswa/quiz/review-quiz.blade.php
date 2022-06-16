@extends('layouts.app')

@push('head')
    <link href="{{ asset("assets/plugins/global/plugins.bundle.css") }}" rel="stylesheet" type="text/css"/>
@endpush

@push('scripts')
    <script src="{{ asset("assets/plugins/global/plugins.bundle.js") }}"></script>
@endpush

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Review Quiz</h2>
                    <div class="card-toolbar">
                        <span class="badge badge-primary">Nilai: {{ $hasil_quiz_siswa->nilai }}</span>
                    </div>
                </div>
                <div id="quiz-form" class="card-body">
                    @csrf
                    @if ($errors->any())
                        {{ $errors }}
                    @endif

                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                    @foreach ($quiz->soals as $key => $soal)
                        <div class="card mb-4 shadow-0 border">
                            <div class="card-body">
                                <h3 class="card-title mb-5">
                                    {{ $key + 1 }}. {{ $soal->soal }}?
                                    @if ($hasil_quiz_siswa->jawabans[$soal->id] == $soal->jawaban)
                                        <span class="badge badge-success">Benar</span>
                                    @else
                                        <span class="badge badge-danger">Salah</span>
                                    @endif
                                </h3> 
                                <div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="radio" name="jawabans[{{ $soal->id }}]" disabled
                                            @if ($hasil_quiz_siswa->jawabans[$soal->id] == "a") checked @endif
                                            value="a">

                                        <label class="form-check-label">
                                            {{ $soal->pilihan_a }}
                                            @if ($soal->jawaban == "a")
                                                <span class="badge badge-success">Benar</span>
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="radio" name="jawabans[{{ $soal->id }}]" disabled
                                            @if ($hasil_quiz_siswa->jawabans[$soal->id] == "b") checked @endif
                                            value="b">

                                        <label class="form-check-label">
                                            {{ $soal->pilihan_b }}
                                            @if ($soal->jawaban == "b")
                                                <span class="badge badge-success">Benar</span>
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="radio" name="jawabans[{{ $soal->id }}]" disabled
                                            @if ($hasil_quiz_siswa->jawabans[$soal->id] == "c") checked @endif
                                            value="c">

                                        <label class="form-check-label">
                                            {{ $soal->pilihan_c }}
                                            @if ($soal->jawaban == "c")
                                                <span class="badge badge-success">Benar</span>
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="radio" name="jawabans[{{ $soal->id }}]" disabled
                                            @if ($hasil_quiz_siswa->jawabans[$soal->id] == "d") checked @endif
                                            value="d">

                                        <label class="form-check-label">
                                            {{ $soal->pilihan_d }}
                                            @if ($soal->jawaban == "d")
                                                <span class="badge badge-success">Benar</span>
                                            @endif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection