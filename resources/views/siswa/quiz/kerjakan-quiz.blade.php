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
                    <h2 class="py-8">Kerjakan Quiz</h2>
                    <div class="card-toolbar">
                        <h4 id="demo"></h4>
                    </div>
                </div>
                <form action="{{ route("siswa.pertemuan.quiz.kumpulQuiz", ["pertemuan_id" => $pertemuan->id, "quiz_id" => $quiz->id]) }}" method="post" id="quiz-form" class="card-body">
                    @csrf
                    @if ($errors->any())
                        {{ $errors }}
                    @endif

                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                    @foreach ($quiz->soals as $key => $soal)
                        <div class="card mb-4 shadow-0 border">
                            <div class="card-body">
                                <h3 class="card-title mb-5">{{ $key + 1 }}. {{ $soal->soal }}?</h3>
                                <div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="radio" name="jawabans[{{ $soal->id }}]" value="a">
                                        <label class="form-check-label">
                                            {{ $soal->pilihan_a }}
                                        </label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="radio" name="jawabans[{{ $soal->id }}]" value="b">
                                        <label class="form-check-label">
                                            {{ $soal->pilihan_b }}
                                        </label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="radio" name="jawabans[{{ $soal->id }}]" value="c">
                                        <label class="form-check-label">
                                            {{ $soal->pilihan_c }}
                                        </label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="radio" name="jawabans[{{ $soal->id }}]" value="d">
                                        <label class="form-check-label">
                                            {{ $soal->pilihan_d }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Set the date we're counting down to
    function countdownTimeStart(){
        var countDownDate = new Date("{{ \Carbon\Carbon::now()->subMinutes(-$quiz->durasi_quiz)->format('Y-m-d H:i:s') }}").getTime();
    
        // Update the count down every 1 second
        var x = setInterval(function() {
    
            // Get todays date and time
            var now = new Date().getTime();
            
            // Find the distance between now an the count down date
            var distance = countDownDate - now;
            
            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = hours + "h "
            + minutes + "m " + seconds + "s ";
            
            // If the count down is over, write some text 
            if (distance < 0) {
                document.getElementById("quiz-form").submit();
            }
        }, 1000);
    }

    countdownTimeStart();
    </script>
@endpush